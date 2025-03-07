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
//    Route::get('', [StoreController::class, 'index'])
//        ->name('stores.index');
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
});

require __DIR__.'/auth.php';
