<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Livewire\Forms\ShippingForm;
use App\Mail\AdminOrderNotification;
use App\Models\Item as ItemModel;
use App\Models\Order;
use App\Models\Orderline;
use App\Models\User;
use App\Traits\SweetAlertTrait;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Mail;

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
        // validate the form
        $this->form->validate();
        // hide the modal
        $this->showModal = false;
        // check if there are records in backorder
        $this->updateBackorder();

        // Store cart items and shipping details before clearing
        $cartItems = Cart::getItems();
        $shippingDetails = [
            'address' => $this->form->address,
            'city' => $this->form->city,
            'zip' => $this->form->zip,
            'country' => $this->form->country,
            'notes' => $this->form->notes,
        ];

        // Create the order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_price' => Cart::getTotalPrice(),
        ]);

        // loop over the records in the basket and add them to the orderlines table
        foreach ($cartItems as $item) {
            Orderline::create([
                'order_id' => $order->id,
                'name' => $item['name'],
                'description' => $item['description'],
                'price' => $item['price'],
                'total_price' => $item['price'],
                'quantity' => $item['qty'],
            ]);
            // update the stock
            $updateQty = ItemModel::findOrFail($item['id']);
            $updateQty->stock > $item['qty'] ? $updateQty->stock -= $item['qty'] : $updateQty->stock = 0;
            $updateQty->save();
        }

        // Send customer confirmation email
        $this->form->sendEmail($this->backorder);

        // Send admin notification email
        $this->sendAdminNotification($order, $cartItems, $shippingDetails, $this->backorder);

        // reset the form, backorder array and error bag
        $this->form->reset();
        $this->reset('backorder');
        $this->resetErrorBag();
        // empty the cart
        Cart::empty();
        $this->dispatch('basket-updated');
        // show a confirmation message
        $this->swalToast("Thank you for your order.<br>The records will be shipped as soon as possible.");
    }

    /**
     * Send admin notification email for new orders
     */
    private function sendAdminNotification(Order $order, array $cartItems, array $shippingDetails, array $backorderItems)
    {
        try {
            // Get all admin users
            $admins = User::where('admin', true)->get();

            if ($admins->count() > 0) {
                // Create the admin notification email
                $adminMail = new AdminOrderNotification($order, $cartItems, $shippingDetails, $backorderItems);

                // Send to all admins
                foreach ($admins as $admin) {
                    Mail::to($admin->email)->send($adminMail);
                }

                // Log successful admin notification
                \Log::info("Admin notification sent for order #{$order->id} to {$admins->count()} admin(s)");
            } else {
                // Log if no admins found
                \Log::warning("No admin users found to notify for order #{$order->id}");
            }
        } catch (\Exception $e) {
            // Log email sending errors but don't interrupt the order process
            \Log::error("Failed to send admin notification for order #{$order->id}: " . $e->getMessage());
        }
    }

    public function emptyBasket()
    {
        Cart::empty();
        $this->dispatch('basket-updated');
    }

    public function decreaseQty($itemId)
    {
        $item = ItemModel::findOrFail($itemId);
        Cart::delete($item);
        $this->dispatch('basket-updated');
    }

    public function increaseQty($itemId)
    {
        $item = ItemModel::findOrFail($itemId);

        // Refresh item to get current stock from database
        $item = $item->fresh();

        // Check stock before increasing
        $currentQtyInCart = Cart::getOneItem($item->id)['qty'] ?? 0;
        $newTotalQty = $currentQtyInCart + 1;

        if ($newTotalQty > $item->stock) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Cannot add more <b><i>{$item->name}</i></b>. Only {$item->stock} available in stock.",
            ]);
            return;
        }

        // Try to add to cart (Cart::add will also validate)
        $success = Cart::add($item);

        if (!$success) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Cannot add more <b><i>{$item->name}</i></b>. Stock limit reached.",
            ]);
            return;
        }

        $this->dispatch('basket-updated');
    }

    public function removeFromCart($itemId)
    {
        Cart::removeItem($itemId);
        $this->dispatch('basket-updated');
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "Item removed from basket.",
        ]);
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
