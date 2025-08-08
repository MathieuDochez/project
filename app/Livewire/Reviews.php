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

    public function getReviewStatistics()
    {
        $reviews = Review::all();

        return [
            'total' => $reviews->count(),
            'average' => $reviews->avg('rating') ?? 0,
            'distribution' => [
                5 => $reviews->where('rating', 5)->count(),
                4 => $reviews->where('rating', 4)->count(),
                3 => $reviews->where('rating', 3)->count(),
                2 => $reviews->where('rating', 2)->count(),
                1 => $reviews->where('rating', 1)->count(),
            ]
        ];
    }

    #[Layout('layouts.project', [
        'title' => 'Reviews - The Dog Kennel',
        'subtitle' => 'Customer Reviews',
        'description' => 'Read authentic reviews from our satisfied customers and share your own experience with The Dog Kennel'
    ])]
    public function render()
    {
        $reviews = Review::latest()
            ->with('user')
            ->paginate(10);

        $stats = $this->getReviewStatistics();

        return view('livewire.reviews', [
            'reviews' => $reviews,
            'stats' => $stats
        ]);
    }
}
