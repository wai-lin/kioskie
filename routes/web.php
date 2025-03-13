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
    Route::get('list', [StoreController::class, 'showStoresList'])
        ->name('stores.list');
    Route::get('{store}/products', [StoreController::class, 'showStoreProducts'])
        ->name('stores.products');
});

Route::post('transactions/order', [TransactionController::class, 'order'])
    ->name('transactions.order');

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
    Route::resource('transactions', TransactionController::class)->only('index');

    Route::get('stores/{store}/link-products', [StoreController::class, 'linkProductsForm'])
        ->name('stores.link_products_form');
    Route::put('stores/{store}/link-products', [StoreController::class, 'linkProducts'])
        ->name('stores.link_products');

    Route::get('stores/{store}/{product}/edit-stock', [StoreController::class, 'editProductStockForm'])
        ->name('stores.edit_stock_form');
    Route::put('stores/{store}/{product}/edit-stock', [StoreController::class, 'editProductStock'])
        ->name('stores.edit_stock');
});

require __DIR__.'/auth.php';
