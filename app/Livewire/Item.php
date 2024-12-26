<?php

namespace App\Livewire;

use App\Helpers\Cart;
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
        $this->items = ItemModel::all(); // Fetch all items from the database
        $this->updateBasketView();
    }

    protected function updateBasketView()
    {
        var_dump(
            Cart::getItems()
        );
        // Directly retrieve the items from the session-based cart
        $this->basketItems = Cart::getItems();
    }

    public function addToBasket(ItemModel $item)
    {
        // Add item to the cart
        Cart::add($item);

        // Dispatch event to update the basket
        $this->dispatch('basket-updated');

        // Dispatch success message with the correct attributes
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The item <b><i>{$item->item}</i></b> has been added to your shopping basket", // Use $item->item here
        ]);
    }

    #[Layout('layouts.project', ['title' => 'Item', 'description' => 'Dog kennel Item'])]
    public function render()
    {
        return view('livewire.shop'); // Render your shop view with the available items
    }
}
