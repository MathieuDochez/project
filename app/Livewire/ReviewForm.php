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

        // Reset input fields
        $this->reset(['rating', 'comment']);

        // Update the parent's reviews property directly
        $this->reviews = Review::all();

        // Show a success message
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'timer' => 5000,
            'html' => 'Successfully updated ',
        ]);

        return redirect()->route('reviews');
    }

    public function render()
    {
        return view('livewire.review-form');
    }
}
