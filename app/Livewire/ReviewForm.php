<?php
namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ReviewForm extends Component
{
    public $rating;
    public $comment;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:1000|min:10',
    ];

    protected $messages = [
        'rating.required' => 'Please select a star rating',
        'rating.min' => 'Rating must be at least 1 star',
        'rating.max' => 'Rating cannot exceed 5 stars',
        'comment.required' => 'Please share your experience with us',
        'comment.min' => 'Please provide at least 10 characters in your review',
        'comment.max' => 'Review cannot exceed 1000 characters',
    ];

    public function submitReview()
    {
        $this->validate();

        // Create the review
        Review::create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        // Reset form fields
        $this->reset(['rating', 'comment']);

        // Dispatch event to refresh parent component
        $this->dispatch('reviewSubmitted');

        // Show success message with personalized content
        $ratingText = match($this->rating) {
            5 => "We're thrilled you had an excellent experience! 🌟",
            4 => "Thank you for the wonderful feedback! 😊",
            3 => "We appreciate your honest feedback! 👍",
            2 => "Thank you for your feedback - we'll work to improve! 💪",
            1 => "We're sorry to hear about your experience and will address your concerns! 🙏",
            default => "Thank you for your review!"
        };

        $this->dispatch('swal:toast', [
            'background' => 'success',
            'timer' => 5000,
            'html' => "Review submitted successfully! {$ratingText}",
        ]);

        // Optional: Redirect to reviews page to see the new review
        // return redirect()->route('reviews');
    }

    public function render()
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return view('livewire.review-form-guest');
        }

        return view('livewire.review-form');
    }
}
