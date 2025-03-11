<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::prefix('stores')->group(function () {
    Route::get('list', [StoreController::class, 'storesList'])
        ->name('stores.list');
    Route::get('{store}/products', [StoreController::class, 'storeProducts'])
        ->name('stores.products');
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);
    Route::resource('transactions', TransactionController::class);

    Route::get('stores/{store}/link-products', [StoreController::class, 'linkProductsForm'])
        ->name('stores.link_products_form');
    Route::put('stores/{store}/link-products', [StoreController::class, 'linkProducts'])
        ->name('stores.link_products');
});

require __DIR__.'/auth.php';
