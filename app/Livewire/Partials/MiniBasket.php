<?php

namespace App\Livewire\Partials;

use App\Helpers\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniBasket extends Component
{
    public $totalQty;

    public function mount()
    {
        $this->totalQty = Cart::getTotalQty(); // Initialize totalQty from Cart
    }

    #[On('basket-updated')]
    public function updateTotalQty()
    {
        $this->totalQty = Cart::getTotalQty(); // Recalculate totalQty on event
    }

    public function render()
    {
        return view('livewire.partials.mini-basket', ['totalQty' => $this->totalQty]);
    }
}
