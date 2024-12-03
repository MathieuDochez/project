<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Shop extends Component
{
    public $items;
    #[Layout('layouts.project', ['title' => 'Shop', 'description' => 'Welcome to our shop'])]

    public function mount()
    {
        $this->items = \App\Models\Shop::all();
    }

    public function render()
    {
        return view('livewire.shop');
    }
}
