<?php

namespace App\Livewire\Partials;

use App\Helpers\Cart;
use Livewire\Attributes\On;
use Livewire\Component;

class MiniBasket extends Component
{
    #[On('basket-updated')]
    public function render()
    {
        return view('livewire.partials.mini-basket', ['totalQty' => $this->totalQty]);
    }
}
