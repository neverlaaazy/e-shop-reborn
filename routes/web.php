<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FirstPageController;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::redirect('/', '/p-main');



Route::get('/products',[ProductController::class, 'index'])
            ->name('products.index');

Route::get('/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

Route::get('/categories/{category}', [CategoryController::class, 'show'])
            ->name('categories.show');

Route::get('/products/create',[ProductController::class, 'create'])
            ->name('products.create');

Route::post('/products',[ProductController::class,'store'])
            ->name('products.store');

Route::get('/products/{product}',[ProductController::class,'show'])
            ->name('products.show');

Route::get('/products/{product}/edit',[ProductController::class,'edit'])
            ->name('products.edit');

Route::put('/products/{product}',[ProductController::class, 'update'])
            ->name('products.update');

Route::delete('/products/{product}',[ProductController::class,'destroy'])
            ->name('products.destroy');


Route::get('/p-main', [FirstPageController::class, 'show'])->name('products.p-main');

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
