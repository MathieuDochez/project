<?php

namespace App\Livewire\Partials;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Name extends Component
{
    public $name;

    public function mount()
    {
        $this->name = Auth::user()->name;
    }

    public function render()
    {
        return view('livewire.partials.name');
    }
}
