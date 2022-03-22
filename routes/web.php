<?php

use App\Http\Controllers\{AuthController, CartController, ProductController, TransactionController, UserController};
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

Route::middleware('guest')->group(function() {
    Route::view('login', 'auth.login')->name('login');
    Route::post('login', [AuthController::class, 'login'])->name('login.post');
});

Route::middleware('auth')->group(function() {
    Route::get('/', function () {
        return view('home');
    })->name('home');

    Route::get('/home', function(){
        return view('home-customer', [
            'products' => \App\Models\Product::latest()->paginate(12)
        ]);
    })->name('home.customer');

    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::controller(CartController::class)->group(function(){
        Route::post('/carts', 'store')->name('carts.store');
        Route::get('/carts', 'index')->name('carts.index');
        Route::delete('/carts/{cart}', 'destroy')->name('carts.delete');
    });

    Route::controller(UserController::class)->group(function() {
        Route::get('users', 'index')->name('users.index');
        Route::get('users/create', 'create')->name('users.create');
        Route::post('users', 'store')->name('users.store');
        Route::get('users/{user}/edit', 'edit')->name('users.edit');
        Route::put('users/{user}', 'update')->name('users.update');
        Route::delete('users/{user}', 'destroy')->name('users.delete');
    });

    Route::controller(ProductController::class)->middleware(['toko'])->group(function() {
        Route::get('products', 'index')->name('products.index');
        Route::get('products/create', 'create')->name('products.create');
        Route::post('products', 'store')->name('products.store');
        Route::get('products/{product}/edit', 'edit')->name('products.edit');
        Route::put('products/{product}', 'update')->name('products.update');
        Route::delete('products/{product}', 'destroy')->name('products.delete');
    });

    Route::controller(TransactionController::class)->group(function() {
        Route::get('transactions', 'index')->name('transactions.index');
        Route::get('transactions/history', 'history')->name('transactions.history');
        Route::get('transactions/create', 'create')->name('transactions.create');
        Route::post('transactions', 'store')->name('transactions.store');
        Route::get('transactions/export', 'export')->name('transactions.export');
    });
});

