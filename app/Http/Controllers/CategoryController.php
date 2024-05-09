<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function add() 
    {
        return view('addCategory', [
            "active" => "dashboard"
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => ['required']
        ]);

        Category::create([
            'Name' => $request->Name
        ]);

        return redirect('/');
    }

}
