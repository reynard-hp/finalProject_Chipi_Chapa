<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('dashboard.index', compact('items'), [
            'active' => 'dashboard'
        ]);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('dashboard.show-item', compact('item'), [
            'active' => ''
        ]);
    }

    public function edit($id){
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('dashboard.edit-item', compact('item', 'categories'), [
            'active' => ''
        ]);
    }
}
