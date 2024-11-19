<?php

use App\Livewire\Home;
use App\Livewire\Shop;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('shop', Shop::class)->name('shop');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
