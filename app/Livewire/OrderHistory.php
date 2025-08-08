<?php
namespace App\Livewire;

use App\Models\Order;
use App\Models\Orderline;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class OrderHistory extends Component
{
    use WithPagination;

    public function getOrderStatistics()
    {
        $orders = Order::where('user_id', auth()->id())->get();

        return [
            'total_orders' => $orders->count(),
            'total_spent' => $orders->sum(function($order) {
                return $order->getTotalPriceAttribute();
            }),
            'average_order' => $orders->count() > 0 ?
                $orders->sum(function($order) {
                    return $order->getTotalPriceAttribute();
                }) / $orders->count() : 0,
            'recent_orders' => $orders->where('created_at', '>=', now()->subDays(30))->count()
        ];
    }

    #[Layout('layouts.project', [
        'title' => 'Order History - The Dog Kennel',
        'subtitle' => 'Your Order History',
        'description' => 'View your complete order history and track your purchases from The Dog Kennel'
    ])]
    public function render()
    {
        $orders = Order::where('user_id', auth()->id())
            ->with(['orderlines', 'user'])
            ->latest()
            ->paginate(10);

        $stats = $this->getOrderStatistics();

        return view('livewire.order-history', [
            'orders' => $orders,
            'stats' => $stats
        ]);
    }
}
