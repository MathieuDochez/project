<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewForm extends Component
{
    public $rating;
    public $comment;

    public function submitReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        Review::create([
            'user_id' => auth()->check() ? auth()->id() : null,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('success', 'Thank you for your feedback!');

        // Emit an event to notify the parent component (optional)
        $this->emit('reviewSubmitted');
    }

    public function render()
    {
        if (!auth()->check()) {
            return view('livewire.review-form-guest'); // View for guests not logged in
        }

        return view('livewire.review-form'); // Default form for logged-in users
    }
}
