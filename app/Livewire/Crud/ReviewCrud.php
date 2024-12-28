<?php
namespace App\Livewire\Crud;

use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class ReviewCrud extends Component
{
    use WithPagination;

    public $rating;
    public $comment;
    public $reviewId;
    public $isEditing = false;

    protected $rules = [
        'rating' => 'required|integer|min:1|max:5',
        'comment' => 'required|string|max:500',
    ];

    public function createReview()
    {
        $this->validate();

        Review::create([
            'user_id' => auth()->id(),
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Review successfully added!',
        ]);
    }

    public function editReview($id)
    {
        $this->isEditing = true;
        $review = Review::findOrFail($id);
        $this->reviewId = $review->id;
        $this->rating = $review->rating;
        $this->comment = $review->comment;
    }

    public function updateReview()
    {
        $this->validate();

        $review = Review::findOrFail($this->reviewId);
        $review->update([
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->resetForm();
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => 'Review successfully updated!',
        ]);
    }

    public function deleteReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        $this->dispatch('swal:toast', [
            'background' => 'error',
            'html' => 'Review successfully deleted!',
        ]);
    }

    private function resetForm()
    {
        $this->rating = '';
        $this->comment = '';
        $this->reviewId = null;
        $this->isEditing = false;
    }

    #[Layout('layouts.project', ['title' => '', 'description' => 'Dog kennel Item'])]
    public function render()
    {
        $reviews = Review::orderBy('id', 'desc')->paginate(10);
        return view('livewire.crud.review-crud', [
            'reviews' => $reviews
        ]);
    }
}
