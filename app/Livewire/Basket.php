<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Livewire\Forms\ShippingForm;
use App\Models\Item as ItemModel;
use App\Models\Order;
use App\Models\Orderline;
use App\Traits\SweetAlertTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Basket extends Component
{
    use SweetAlertTrait;

    public $backorder = [];
    public $showModal = false;
    public ShippingForm $form;

    public function checkoutForm()
    {
        $this->form->reset();
        $this->resetErrorBag();
        $this->showModal = true;
    }

    public function checkout()
    {
        try {
            // validate the form
            $this->form->validate();

            // hide the modal
            $this->showModal = false;

            // check if there are records in backorder
            $this->updateBackorder();

            // Create order
            $order = Order::create([
                'user_id' => auth()->user()->id,
                'total_price' => Cart::getTotalPrice(),
            ]);

            // Create orderlines and update stock
            foreach (Cart::getItems() as $item) {
                Orderline::create([
                    'order_id' => $order->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'total_price' => $item['price'],  // BACK TO ORIGINAL
                    'quantity' => $item['qty'],
                ]);

                // Update stock
                $updateQty = ItemModel::findOrFail($item['id']);
                $updateQty->stock > $item['qty'] ? $updateQty->stock -= $item['qty'] : $updateQty->stock = 0;
                $updateQty->save();
            }

            // Send confirmation email - REQUIRED (no silent failures)
            $this->form->sendEmail($this->backorder);

            // Reset everything
            $this->form->reset();
            $this->reset('backorder');
            $this->resetErrorBag();

            // Empty cart and update basket
            Cart::empty();
            $this->dispatch('basket-updated');

            // Show success message
            $this->swalToast("Thank you for your order.<br>The records will be shipped as soon as possible.");

        } catch (\Exception $e) {
            // User-friendly error message - includes email failures
            $this->swalToast("Something went wrong. Please try again.", 'error');
        }
    }

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
                $this->backorder[] = $shortage . ' x ' . $item->name;
        }
    }

    #[On('basket-updated')]
    #[Layout('layouts.project', ['title' => 'Your shopping basket', 'description' => 'Your shopping basket',])]
    public function render()
    {
        $this->updateBackorder();
        return view('livewire.basket', [
            'totalQty' => Cart::getTotalQty(),
            'totalPrice' => Cart::getTotalPrice(),
            'items' => Cart::getItems(),
        ]);
    }
}
