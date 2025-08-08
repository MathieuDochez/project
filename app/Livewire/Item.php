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
        $this->items = ItemModel::orderBy('name')->get(); // Fetch all items, ordered by name
        $this->updateBasketView();
    }

    protected function updateBasketView()
    {
        // Directly retrieve the items from the session-based cart
        $this->basketItems = Cart::getItems();
    }

    public function addToBasket(ItemModel $item)
    {
        // Check stock before adding
        if ($item->stock <= 0) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Sorry, <b><i>{$item->name}</i></b> is currently out of stock!",
            ]);
            return;
        }

        // Add item to the cart
        Cart::add($item);

        // Dispatch event to update the basket
        $this->dispatch('basket-updated');

        // Dispatch success message with the correct attributes
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "<b><i>{$item->name}</i></b> has been added to your shopping basket! 🐕",
        ]);
    }

    #[Layout('layouts.project', ['title' => 'Shop - The Dog Kennel', 'subtitle' => 'Shop', 'description' => 'Premium dog supplies and accessories for your beloved companion'])]
    public function render()
    {
        return view('livewire.shop');
    }
}
