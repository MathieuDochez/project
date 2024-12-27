<?php
namespace App\Livewire\Crud;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OrderCrud extends Component
{
    public $orders;
    public $order_id, $user_id, $total_price;
    public $isEditing = false;

    // Mount method to fetch orders from the database
    public function mount()
    {
        $this->orders = Order::with('user', 'orderline')->paginate(10);
    }

    // Method to handle creating a new order
    public function store()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',  // Ensure user exists
            'price' => 'required|numeric|min:0',  // Ensure price is valid
        ]);

        Order::create([
            'user_id' => $this->user_id,
            'price' => $this->total_price,
        ]);

        $this->resetForm();
        $this->dispatch('swal:toast', ['background' => 'success', 'html' => 'Order created successfully!']);
        $this->mount();  // Refresh orders list
    }

    // Method to handle updating an existing order
    public function edit($id)
    {
        $this->isEditing = true;
        $order = Order::findOrFail($id);
        $this->order_id = $order->id;
        $this->user_id = $order->user_id;
        $this->total_price = $order->total_price;
    }

    // Method to handle saving updates
    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'price' => 'required|numeric|min:0',
        ]);

        $order = Order::findOrFail($this->order_id);
        $order->update([
            'user_id' => $this->user_id,
            'price' => $this->total_price,
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
