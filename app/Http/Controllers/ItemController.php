<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function create() {
        $categories = Category::all();
        return view('addItem', [
            'categories' => $categories,
            'active' => 'dashboard'
        ]);
    }
    

    public function store(Request $request) {
        $request->validate([
            'Name' => ['required', 'min:5', 'max:80'],
            'Price' => ['required'],
            'Quantity' => ['required'],
            'Photo' => ['image', 'required'],
            'CategoryId' => ['required']
        ]);

        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('Photo')->getClientOriginalName();
        $request->file('Photo')->storeAs('/public'.'/', $filename);
         
        Item::create([
            'Name' => $request->Name,
            'Price' =>$request->Price,
            'Quantity' => $request->Quantity,
            'Photo' => $filename,
            'CategoryId' => $request->CategoryId
        ]);

        return redirect('/');
    }

    public function show() {
        $items = Item::all();
        $categories = Category::all();
        $invoiceItems = session()->get('invoice_items', []);
        $existingItemIds = collect($invoiceItems)->pluck('id')->toArray();
        return view('list-item', compact('items', 'categories', 'existingItemIds'), [
            "active" => "list-item"
        ]);
    }

    public function update(Request $request, Item $item) {
        $request->validate([
            'Name' => ['required', 'min:5', 'max:80'],
            'Price' => ['required'],
            'Quantity' => ['required'],
            'Photo' => ['image'],
            'CategoryId' => ['required']
        ]);
    
        
        if ($request->hasFile('Photo')) {
            $now = now()->format('Y-m-d_H.i.s');
            $filename = $now . '_' . $request->file('Photo')->getClientOriginalName();
            $request->file('Photo')->storeAs('/public', $filename);
    
            $item->update([
                'Name' => $request->Name,
                'Price' => $request->Price,
                'Quantity' => $request->Quantity,
                'Photo' => $filename, 
                'CategoryId' => $request->CategoryId
            ]);
        } else {
            $item->update([
                'Name' => $request->Name,
                'Price' => $request->Price,
                'Quantity' => $request->Quantity,
                'CategoryId' => $request->CategoryId
            ]);
        }
    
        return redirect('/dashboard')->with('success', 'Item telah diupdate!');
    }

    public function delete(Item $item)
    {
        $item->delete();

        return redirect('/dashboard')->with('success','Item telah dihapus!');
    }
}
