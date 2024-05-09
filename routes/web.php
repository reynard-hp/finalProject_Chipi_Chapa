<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', [
        "active" => "home"
    ]);
});

Route::get('/list-item', [ItemController::class, 'show']);
Route::get('/add-item', [ItemController::class, 'create'])->middleware('admin');
Route::post('/items', [ItemController::class, 'store']);
Route::patch('/update-item/{item:id}', [ItemController::class, 'update']);
Route::delete('/delete-item/{item:id}', [ItemController::class, 'delete']);


Route::get('/add-category', [CategoryController::class, 'add'])->middleware('admin');
Route::post('/categories', [CategoryController::class, 'store']);

Route::get('/invoice-form', [InvoiceController::class, 'showInvoiceForm'])->middleware('user');
Route::get('/history', [InvoiceController::class, 'showHistory'])->middleware('user');
Route::post('/create-invoice', [InvoiceController::class, 'storeInvoice']);
Route::post('/add-to-invoice/{item:id}', [InvoiceController::class, 'addToInvoice'])->middleware('user');
Route::post('/update-quantity/{itemId}', [InvoiceController::class, 'updateQuantity']);
Route::delete('/delete-item/{item:id}', [InvoiceController::class, 'deleteFromInvoice']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('admin');
Route::get('/dashboard/items/{item:id}', [DashboardController::class, 'show'])->middleware('admin');
Route::get('/edit-item/{item:id}', [DashboardController::class, 'edit'])->middleware('admin');