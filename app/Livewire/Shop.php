<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Shop extends Component
{
    #[Layout('layouts.project', ['title' => 'Shop', 'description' => 'Welcome to our shop'])]


    public function render()
    {
        return view('livewire.shop');
    }
}
