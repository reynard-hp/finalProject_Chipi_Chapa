<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Item;
use App\Models\User;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function showInvoiceForm()
    {
        $user = auth()->user();
        $invoiceItems = session()->get('invoice_items', []);
        return view("invoiceForm", [
            "invoiceItems" => $invoiceItems,
            "user" => $user,
            "active" => 'invoice'
        ]);
    }

    // InvoiceController.php

    public function addToInvoice($itemId)
    {
        $item = Item::findOrFail($itemId);

        $item['quantity'] = 1;

        $invoiceItems = session()->get('invoice_items', []);
        $invoiceItems[$itemId] = $item;
        session()->put('invoice_items', $invoiceItems);

        return redirect()->back()->with('success', 'Item berhasil ditambahkan ke dalam faktur.');
    }

    public function deleteFromInvoice($itemId)
    {
        if (session()->has('invoice_items')) {
            $invoiceItems = session()->get('invoice_items');

            if (array_key_exists($itemId, $invoiceItems)) {
                unset($invoiceItems[$itemId]);
                session()->put('invoice_items', $invoiceItems);
            }
            return redirect()->back()->with('success', 'Item telah dihapus dari faktur');
        }
    }

    public function updateQuantity(Request $request, $itemId)
    {   
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $invoiceItems = session()->get('invoice_items');
    
        if (isset($invoiceItems[$itemId])) {
            $invoiceItems[$itemId]['quantity'] = $request->quantity;
            session()->put('invoice_items', $invoiceItems);
        }
    
        return redirect()->back();
    }
    public function storeInvoice(Request $request)
    {
        $request->validate([
            'address' => 'required|string|min:10|max:100',
            'postal_code' => 'required|digits:5',
            'quantities' => 'required|array',
            'quantities.*' => 'integer|min:1',
        ], [
            'quantities.required' => 'Please select at least one item.',
        ]);

        // Get User ID
        $userId = auth()->id();
        
        $invoice = new Invoice();
        $invoice->UserId = $userId;
        $invoice->address = $request->address;
        $invoice->postal_code = $request->postal_code;
        $invoice->total_price = 0;

        $invoice->save();
        $totalPrice = 0;

        foreach ($request->quantities as $itemId => $quantity) {
            $item = Item::findOrFail($itemId);
            if ($item->Quantity < $quantity) {
                return back()->withErrors(['out_of_stock' => 'Barang '. $item->Name . ' sudah habis, silakan tunggu hingga barang di-restock ulang.']);
            }

            $invoiceDetail = new InvoiceDetail();
            $invoiceDetail->InvoiceId = $invoice->id; 
            $invoiceDetail->ItemId = $item->id;
            $invoiceDetail->quantity = $quantity;
            $invoiceDetail->save();

            $totalPrice += $item->Price * $quantity;
        }

        foreach ($request->quantities as $itemId => $quantity) {
            $item = Item::findOrFail($itemId);
            $item->decrement('Quantity', $quantity);
        }

        $invoice->total_price = $totalPrice;
        $invoice->save();

        session()->forget('invoice_items');

        return redirect()->back()->with('success', 'Faktur berhasil disimpan.');
    }

    public function showHistory() {
        $userId = auth()->id();

        $user = User::findOrFail($userId);
        $invoices = $user->invoices()->get();

        return view('history', [
            "active" => "history",
            "user" => $user,
            "invoices" => $invoices
        ]);
    }
}
