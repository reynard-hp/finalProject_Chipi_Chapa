<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index', [
            'active' => 'register'
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|min:3|max:40',
            'email' => ['required', 'email', 'ends_with:@gmail.com', 'unique:users'],
            'password' => 'required|string|min:6|max:12',
            'confirm-password' => ['required', 'same:password'],
            'nomor_handphone' => ['required', 'string', 'starts_with:08']
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        return redirect('/login')->with('success', 'Registration successful!');
    }
}
