<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

    Route::middleware('auth')->prefix('pdf')->group(function() {
    Route::get('/list',[PdfController::class, 'index'])->name('pdf.index');
    Route::get('/create',[PdfController::class, 'create'])->name('pdf.create');
    Route::post('/store', [PdfController::class, 'store'])->name('pdf.store');
    Route::post('/cart/add/{id}',[CartController::class, 'add'])->name('cart.add');
    Route::get('/cart/view',[CartController::class, 'viewCart'])->name('cart.view');
    // Route pour incrémenter la quantité  
    Route::post('/cart/increment/{id}', [CartController::class, 'increment'])->name('cart.increment');
   // Route pour décrémenter la quantité
    Route::post('/cart/decrement/{id}', [CartController::class, 'decrement'])->name('cart.decrement');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
    Route::get('/order/confirmation', [OrderController::class, 'confirmation'])->name('order.confirmation');
    Route::get('/success', [OrderController::class, 'success'])->name('order.success');
    Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    //Route::post('/contact/{property}',[UserController::class, 'contact'])->name('properties.contact');
    //Route::get('/edit/{id}',[UserController::class, 'edit'])->name('users.edit');
    //Route::get('/show/{property}',[UserController::class, 'show'])->name('properties.show');
   // Route::put('/update/{id}',[UserController::class, 'update'])->name('users.update');
   // Route::get('/delete/{id}',[UserController::class, 'delete'])->name('users.delete');
    });



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';