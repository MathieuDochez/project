<?php

use App\Livewire\Crud\DogCrud;
use App\Livewire\Crud\ItemCrud;
use App\Livewire\Crud\OrderCrud;
use App\Livewire\Crud\ReviewCrud;
use App\Livewire\Crud\UserCrud;
use App\Livewire\DogGallery;
use App\Livewire\Reviews;
use App\Livewire\Item;
use App\Livewire\Basket;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');
Route::get('shop', Item::class)->name('shop');
Route::get('reviews', Reviews::class)->name('reviews');
Route::view('contact', 'contact')->name('contact');
Route::get('basket', Basket::class)->name('basket');
Route::get('dog-gallery', DogGallery::class)->name('dog-gallery');
Route::get('dog', DogCrud::class)->name('dog');
Route::get('orders', OrderCrud::class)->name('orders');
Route::get('items', ItemCrud::class)->name('items');
Route::get('reviewcrud', ReviewCrud::class)->name('reviewcrud');
Route::get('users', UserCrud::class)->name('users');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Admin-only Dashboard route
    Route::get('/dashboard', function () {
        if (!auth()->user()->admin) {
            return redirect()->route('home');
        }
        return view('dashboard');
    })->name('dashboard');

    // Admin-only Dog CRUD route
    /*Route::get('/dog', function () {
        if (!auth()->user()->admin) {
            return redirect()->route('home');
        }
        return Route::get('dog', DogCrud::class);
    })->name('dog');*/
});
