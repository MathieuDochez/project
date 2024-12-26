<?php

namespace App\Livewire;

use App\Models\Basket;
use App\Models\Item as ItemModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Item extends Component
{
    public $items;
    public $basketItems = [];

    public function mount()
    {
        $this->items = ItemModel::all();
        $this->updateBasketView();
    }

    protected function updateBasketView()
    {
        $this->basketItems = Basket::where('user_id', Auth::id())
            ->with('item') // Adjust this based on your relationships
            ->get();
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
        $this->updateBasketView();
    }



    #[Layout('layouts.project', ['title' => 'Item', 'description' => 'Dog kennel Item'])]
    public function render()
    {
        return view('livewire.shop');
    }
}
