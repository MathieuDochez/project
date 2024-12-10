<?php

namespace App\Livewire;

use App\Helpers\Cart;
use Livewire\Attributes\Layout;
use App\Models\Shop;
use Livewire\Component;

class Basket extends Component
{
    public function emptyBasket()
    {
        Cart::empty();
        $this->dispatch('basket-updated');
    }

    public function decreaseQty(Shop $shop)
    {
        Cart::delete($shop);
        $this->dispatch('basket-updated');
    }

    public function increaseQty(Shop $shop)
    {
        Cart::add($shop);
        $this->dispatch('basket-updated');
    }

    public function placeOrder()
    {

    }

    #[Layout('layouts.project', ['title' => 'Your shopping basket', 'description' => 'Your shopping basket',])]
    public function render()
    {
        return view('livewire.basket');
    }
}

