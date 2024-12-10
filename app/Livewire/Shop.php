<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Shop extends Component
{
    public $items;
    #[Layout('layouts.project', ['title' => 'Shop', 'description' => 'Welcome to our shop'])]

    public function mount()
    {
        $this->items = \App\Models\Shop::all();
    }

    public function render()
    {
        return view('livewire.shop');
    }

    public function addToBasket($itemId)
    {
        // Retrieve the item from the database
        $item = Shop::find();
        // Check if the item is already in the basket
        if (isset($this->basket[$itemId])) {
            // If it is, increment the quantity
            $this->basket[$itemId]['quantity']++;
        } else {
            // If not, add it to the basket with a quantity of 1
            $this->basket[$itemId] = [
                'item' => $item,
                'quantity' => 1,
            ];
        }

        // You can also emit an event to update the basket in other components
        $this->emit('basketUpdated');
    }
}
