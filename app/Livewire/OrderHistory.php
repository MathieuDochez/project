<?php

namespace App\Livewire;

use App\Models\Order;
use App\Models\Orderline;
use Livewire\Attributes\Layout;
use Livewire\Component;

class OrderHistory extends Component
{
    public $orders;
    public $paginate;

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
            $this->orders = Order::where('user_id', auth()->user()->id)->paginate(10);

        } else {
            $this->paginate = false;
            $this->orders = Order::where('user_id', auth()->user()->id)->get();

        }

    }

    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    public function render()
    {

        return view('livewire.order-history', [
            'orders' => $this->orders,
        ]);
    }
}
