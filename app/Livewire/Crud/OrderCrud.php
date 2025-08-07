<?php
namespace App\Livewire\Crud;

use App\Models\Order;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class OrderCrud extends Component
{
    use WithPagination;

    public $order_id, $user_id, $total_price;
    public $isEditing = false;

    // Method to handle updating an existing order
    public function edit($id)
    {
        $this->isEditing = true;
        $order = Order::findOrFail($id);
        $this->order_id = $order->id;
        $this->user_id = $order->user_id;
        $this->total_price = $order->total_price; // Use the actual total_price from database
    }

    // Method to handle saving updates
    public function update()
    {
        $this->validate([
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric|min:0.01',
        ]);

        $order = Order::find($this->order_id);

        // Update the order
        $order->update([
            'user_id' => $this->user_id,
            'total_price' => $this->total_price,
        ]);

        $this->resetForm();
        $this->dispatch('swal:toast', ['background' => 'success', 'html' => 'Order updated successfully!']);
    }

    // Method to handle deleting an order
    public function delete($id)
    {
        Order::findOrFail($id)->delete();
        $this->dispatch('swal:toast', ['background' => 'error', 'html' => 'Order deleted successfully!']);
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
        // Load orders with user and orderlines relationships
        $orders = Order::with(['user', 'orderlines'])->latest()->paginate(10);

        return view('livewire.crud.order-crud', [
            'orders' => $orders,
        ]);
    }
}
