<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    protected $listeners = ['reviewSubmitted' => '$refresh'];

    #[Layout('layouts.project', ['title' => 'Reviews', 'description' => 'Reviews of our products'])]
    public function render()
    {
        $reviews = Review::latest()->with('user')->paginate(10);
        return view('livewire.reviews', compact('reviews'));
    }

}
