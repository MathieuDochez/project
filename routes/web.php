<?php

use App\Livewire\Reviews;
use App\Livewire\Item;
use App\Livewire\Basket;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('shop', Item::class)->name('shop');
Route::get('reviews', Reviews::class)->name('reviews');
Route::view('contact', 'contact')->name('contact');
Route::get('basket', Basket::class)->name('basket');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        if (!auth()->user()->admin) {
            return redirect()->route('home');
        }
        return view('dashboard');
    })->name('dashboard');
});
