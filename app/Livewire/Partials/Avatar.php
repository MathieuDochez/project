<?php
namespace App\Livewire\Partials;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Avatar extends Component
{
    public $avatar;

    public function mount()
    {
        $this->avatar = Auth::user()->profile_photo_url;
    }

    public function render()
    {
        return view('livewire.partials.avatar');
    }
}

