<?php
namespace App\Livewire\Crud;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OrderCrud extends Component
{
    public $orders;
    public $paginate;
    public $order_id, $user_id, $total_price;
    public $isEditing = false;

    // Mount method to fetch orders from the database
    public function mount()
    {
        $this->loadOrders();
    }

    public function loadOrders()
    {
        $totalOrders = Order::count();

        if ($totalOrders > 10) {
            $this->paginate = true;
            $this->orders = Order::paginate(10); // Adjust pagination per page count as needed
        } else {
            $this->paginate = false;
            $this->orders = Order::all(); // Retrieve all orders
        }
    }



    // Method to handle updating an existing order
    public function edit($id)
    {
        $this->isEditing = true;
        $order = Order::findOrFail($id);
        $this->order_id = $order->id;
        $this->user_id = $order->user_id;
        $this->total_price = $order->getTotalPriceAttribute();
    }

    // Method to handle saving updates
    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0.01',
        ]);

        $order = Order::find($this->order_id);
        $orderline = $order->orderline; // Assuming a one-to-one relationship

        // Update the user_id on the order
        $order->update([
            'user_id' => $this->user_id,  // Updating the user ID
        ]);

        // Update the price on the related orderline
        $orderline->update([
            'price' => $this->total_price,  // Update the price in the orderline
        ]);

        $this->resetForm();
        $this->dispatch('swal:toast', ['background' => 'success', 'html' => 'Order updated successfully!']);
        $this->mount();  // Refresh orders list
    }

    // Method to handle deleting an order
    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        $this->dispatch('swal:toast', ['background' => 'error', 'html' => 'Order deleted successfully!']);
        $this->mount();  // Refresh orders list
    }

    // Method to reset the form fields
    public function resetForm()
    {
        $this->order_id = null;
        $this->user_id = null;
        $this->total_price = null;
        $this->isEditing = false;
    }

    // Render the view
    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    public function render()
    {

        return view('livewire.crud.order-crud', [
            'orders' => $this->orders,
        ]);
    }
}
