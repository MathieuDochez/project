<?php

namespace App\Livewire;

use App\Models\Basket;
use App\Models\Shop as ShopModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Shop extends Component
{
    public $items;

    public function mount()
    {
        $this->items = ShopModel::all();
    }

    public function addToBasket($itemId)
    {
        if (!Auth::check()) {
            session()->flash('error', 'Please log in to add items to your basket.');
            return;
        }

        $basketItem = Basket::firstOrCreate(
            ['user_id' => Auth::id(), 'item_id' => $itemId],
            ['quantity' => 0]
        );
        $basketItem->increment('quantity');

        $this->emit('basket-updated');
    }


    #[Layout('layouts.project', ['title' => 'Shop', 'description' => 'Dog kennel Shop'])]
    public function render()
    {
        return view('livewire.shop');
    }
}
