<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Reviews extends Component
{
    use WithPagination;

    // Filter values (will be updated by filter bar)
    public $ratingFilter = '';
    public $sortBy = 'latest';
    public $search = '';
    public $ratingStats = [];

    protected $listeners = [
        'reviewSubmitted' => '$refresh',
        'filtersChanged' => 'updateFilters'
    ];

    protected $queryString = [
        'ratingFilter' => ['except' => ''],
        'sortBy' => ['except' => 'latest'],
        'search' => ['except' => ''],
        'page' => ['except' => 1]
    ];

    public function mount()
    {
        $this->updateRatingStats();
    }

    public function updateFilters($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->ratingFilter = $filters['primaryFilter'] ?? '';
        $this->sortBy = $filters['sortBy'] ?? 'latest';

        $this->resetPage();

        // Update filter bar with current results
        $this->dispatch('updateFilterResults', [
            'total' => $this->reviews->total(),
            'currentPage' => $this->reviews->currentPage(),
            'perPage' => $this->reviews->perPage()
        ]);
    }

    public function updateRatingStats()
    {
        $stats = Review::selectRaw('rating, COUNT(*) as count')
            ->groupBy('rating')
            ->orderBy('rating', 'desc')
            ->get()
            ->pluck('count', 'rating')
            ->toArray();

        $total = array_sum($stats);
        $average = $total > 0 ? Review::avg('rating') : 0;

        $this->ratingStats = [
            'total' => $total,
            'average' => round($average, 1),
            'breakdown' => $stats
        ];
    }

    public function getReviewsProperty()
    {
        return Review::query()
            ->with('user')
            ->when($this->search, function ($query) {
                $query->where('comment', 'like', '%' . $this->search . '%');
            })
            ->when($this->ratingFilter, function ($query) {
                $query->where('rating', $this->ratingFilter);
            })
            ->when($this->sortBy === 'latest', function ($query) {
                $query->latest();
            })
            ->when($this->sortBy === 'oldest', function ($query) {
                $query->oldest();
            })
            ->when($this->sortBy === 'highest_rating', function ($query) {
                $query->orderBy('rating', 'desc')->latest();
            })
            ->when($this->sortBy === 'lowest_rating', function ($query) {
                $query->orderBy('rating', 'asc')->latest();
            })
            ->paginate(10);
    }

    public function getFilterConfig()
    {
        return [
            'searchPlaceholder' => 'Search reviews by comment...',
            'showSearch' => true,
            'showPrimaryFilter' => true,
            'showSortBy' => true,
            'primaryFilterLabel' => 'Rating',
            'primaryFilterOptions' => [
                '5' => '5 Stars',
                '4' => '4 Stars',
                '3' => '3 Stars',
                '2' => '2 Stars',
                '1' => '1 Star'
            ],
            'sortByLabel' => 'Sort By',
            'sortByOptions' => [
                'latest' => 'Latest First',
                'oldest' => 'Oldest First',
                'highest_rating' => 'Highest Rating',
                'lowest_rating' => 'Lowest Rating'
            ],
            'search' => $this->search,
            'primaryFilter' => $this->ratingFilter,
            'sortBy' => $this->sortBy,
        ];
    }

    #[Layout('layouts.project', ['title' => 'Reviews', 'description' => 'Reviews of our products'])]
    public function render()
    {
        $reviews = $this->reviews;

        // Update filter bar with results after render
        $this->dispatch('updateFilterResults', [
            'total' => $reviews->total(),
            'currentPage' => $reviews->currentPage(),
            'perPage' => $reviews->perPage()
        ]);

        return view('livewire.reviews', [
            'reviews' => $reviews,
            'filterConfig' => $this->getFilterConfig()
        ]);
    }
}
