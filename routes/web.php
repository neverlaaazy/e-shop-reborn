<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/products',[ProductController::class, 'index'])
            ->name('products.index');


Route::get('/products/create',[ProductController::class, 'create'])
            ->name('products.create');

Route::post('/products',[ProductController::class,'store'])
            ->name('products.store');

Route::get('/products/{product:slug}',[ProductController::class,'show'])
            ->name('products.show');

Route::get('/products/{product:slug}/edit',[ProductController::class,'edit'])
            ->name('products.edit');

Route::put('/products/{product}',[ProductController::class, 'update'])
            ->name('products.update');


Route::delete('/products/{product}',[ProductController::class,'destroy'])
            ->name('products.destroy');



Route::get('/orders/show',[OrderController::class, 'show'])
        ->name('orders.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
