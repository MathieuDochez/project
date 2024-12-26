<?php
/*
namespace App\Livewire;

use App\Models\Basket as BasketModel;
use App\Models\Item;
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

use App\Helpers\Cart;
use App\Models\Item as ItemModel;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Basket extends Component
{
    public $backorder = [];
    public function emptyBasket()
    {
        Cart::empty();
        $this->dispatch('basket-updated');
    }

    public function decreaseQty(ItemModel $item)
    {
        Cart::delete($item);
        $this->dispatch('basket-updated');
    }

    public function increaseQty(ItemModel $item)
    {
        Cart::add($item);
        $this->dispatch('basket-updated');
    }

    public function updateBackorder()
    {
        $this->backorder = [];
        // loop over records in basket and check if qty > in stock
        foreach (Cart::getKeys() as $id) {
            $qty = Cart::getOneItem($id)['qty'];
            $item = ItemModel::findOrFail($id);
            $shortage = $qty - $item->stock;
            if ($shortage > 0)
                $this->backorder[] = $shortage . ' x ' . $item->item;
        }
    }

    #[On('basket-updated')]
    #[Layout('layouts.project', ['title' => 'Your shopping basket', 'description' => 'Your shopping basket',])]
    public function render()
    {
        $this->updateBackorder();
        @dump(Cart::getItems());
        return view('livewire.basket', [
            'totalQty' =>Cart::getTotalQty(),
            'totalPrice' => Cart::getTotalPrice(),
            'items' => Cart::getItems(),
        ]);
    }
}

