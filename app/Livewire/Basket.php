<?php
/*
namespace App\Livewire;

use App\Models\Basket as BasketModel;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Basket extends Component
{
    public function emptyBasket()
    {
        BasketModel::where('user_id', Auth::id())->delete();
        $this->dispatch('basket-updated');
    }

    public function decreaseQty($itemId)
    {
        $basketItem = BasketModel::where('user_id', Auth::id())->where('item_id', $itemId)->first();
        if ($basketItem && $basketItem->quantity > 1) {
            $basketItem->decrement('quantity');
        } else {
            $basketItem?->delete();
        }
        $this->dispatch('basket-updated');
    }

    public function increaseQty($itemId)
    {
        $basketItem = BasketModel::firstOrCreate(
            ['user_id' => Auth::id(), 'item_id' => $itemId],
            ['quantity' => 0]
        );
        $basketItem->increment('quantity');
        $this->dispatch('basket-updated');
    }

    public function placeOrder()
    {
        // Here, you could add order logic, like creating an Order model and clearing the basket.
    }

    public function render()
    {
        $items = BasketModel::where('user_id', Auth::id())->with('item')->get();
        return view('livewire.basket', ['items' => $items]);
    }
}*/


namespace App\Livewire;

use App\Models\Basket as BasketModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Basket extends Component
{
    public $basketItems = []; // Holds the current user's basket items

    public function mount()
    {
        $this->updateBasketView(); // Load basket data on mount
    }

    public function emptyBasket()
    {
        BasketModel::where('user_id', Auth::id())->delete();
        $this->updateBasketView(); // Refresh the basket data
    }

    public function decreaseQty($itemId)
    {
        $basketItem = BasketModel::where('user_id', Auth::id())->where('item_id', $itemId)->first();
        if ($basketItem && $basketItem->quantity > 1) {
            $basketItem->decrement('quantity');
        } else {
            $basketItem?->delete();
        }

        $this->updateBasketView(); // Refresh the basket data
    }

    public function increaseQty($itemId)
    {
        $basketItem = BasketModel::firstOrCreate(
            ['user_id' => Auth::id(), 'item_id' => $itemId],
            ['quantity' => 0]
        );
        $basketItem->increment('quantity');

        $this->updateBasketView(); // Refresh the basket data
    }

    public function placeOrder()
    {
        // Add order logic here (e.g., creating an Order model, clearing the basket)
        // For now, let's just clear the basket after placing an "order"
        $this->emptyBasket();
    }

    protected function updateBasketView()
    {
        $this->basketItems = BasketModel::where('user_id', Auth::id())
            ->with('item')
            ->get();
    }

    #[Layout('layouts.project', ['title' => 'Basket', 'description' => 'Dog kennel Shop'])]
    public function render()
    {
        return view('livewire.basket', [
            'items' => $this->basketItems, // Pass updated basket data to the view
        ]);
    }
}

