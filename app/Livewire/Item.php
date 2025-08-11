<?php

namespace App\Livewire;

use App\Helpers\Cart;
use App\Models\Item as ItemModel;
use App\Enums\ProductCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Item extends Component
{
    use WithPagination;

    public $basketItems = [];

    // Filter values (will be updated by filter bar)
    public $search = '';
    public $categoryFilter = '';
    public $minPrice = '';
    public $maxPrice = '';
    public $sortBy = 'name';
    public $sortDirection = 'asc';

    protected $listeners = ['filtersChanged' => 'updateFilters'];

    protected $queryString = [
        'search' => ['except' => ''],
        'categoryFilter' => ['except' => ''],
        'minPrice' => ['except' => ''],
        'maxPrice' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
        'sortDirection' => ['except' => 'asc'],
        'page' => ['except' => 1]
    ];

    public function mount()
    {
        $this->updateBasketView();
    }

    public function updateFilters($filters)
    {
        $this->search = $filters['search'] ?? '';
        $this->categoryFilter = $filters['primaryFilter'] ?? '';
        $this->minPrice = $filters['minValue'] ?? '';
        $this->maxPrice = $filters['maxValue'] ?? '';
        $this->sortBy = $filters['sortBy'] ?? 'name';
        $this->sortDirection = $filters['sortDirection'] ?? 'asc';

        $this->resetPage();
    }

    protected function updateBasketView()
    {
        $this->basketItems = Cart::getItems();
    }

    public function addToBasket(ItemModel $item)
    {
        Cart::add($item);
        $this->dispatch('basket-updated');
        $this->dispatch('swal:toast', [
            'background' => 'success',
            'html' => "The item <b><i>{$item->name}</i></b> has been added to your shopping basket",
        ]);
    }

    public function getItemsProperty()
    {
        return ItemModel::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('description', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category', $this->categoryFilter);
            })
            ->when($this->minPrice, function ($query) {
                $query->where('price', '>=', $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                $query->where('price', '<=', $this->maxPrice);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(9);
    }

    #[Layout('layouts.project', ['title' => 'Shop', 'description' => 'Dog kennel Items'])]
    public function render()
    {
        $items = $this->items;

        // Get categories for filter
        $categories = [];
        try {
            if (class_exists('\App\Enums\ProductCategory')) {
                $categories = collect(\App\Enums\ProductCategory::cases())->mapWithKeys(function ($case) {
                    $value = $case->value ?? $case->name;
                    $label = ucfirst(str_replace('_', ' ', $value));
                    return [$value => $label];
                })->toArray();
            } else {
                // Fallback: get from database
                $categoryItems = ItemModel::select('category')->distinct()->whereNotNull('category')->get();
                foreach ($categoryItems as $item) {
                    $category = $item->category;
                    if (is_object($category)) {
                        $value = $category->value ?? $category->name ?? (string)$category;
                    } else {
                        $value = $category;
                    }
                    $categories[$value] = ucfirst(str_replace('_', ' ', $value));
                }
            }
        } catch (\Exception $e) {
            $categories = [
                'food' => 'Food',
                'toys' => 'Toys',
                'accessories' => 'Accessories',
                'training' => 'Training'
            ];
        }

        // Create filter configuration
        $filterConfig = [
            'searchPlaceholder' => 'Search items by name or description...',
            'showSearch' => true,
            'showPrimaryFilter' => true,
            'showMinMaxFilter' => true,
            'showSortBy' => true,
            'showSortDirection' => true,
            'primaryFilterLabel' => 'Category',
            'primaryFilterOptions' => $categories,
            'minValueLabel' => 'Min Price (€)',
            'maxValueLabel' => 'Max Price (€)',
            'sortByLabel' => 'Sort By',
            'sortByOptions' => [
                'name' => 'Name',
                'price' => 'Price',
                'created_at' => 'Date Added'
            ],
            'search' => $this->search,
            'primaryFilter' => $this->categoryFilter,
            'minValue' => $this->minPrice,
            'maxValue' => $this->maxPrice,
            'sortBy' => $this->sortBy,
            'sortDirection' => $this->sortDirection,
        ];

        return view('livewire.shop', [
            'items' => $items,
            'filterConfig' => $filterConfig
        ]);
    }
}
