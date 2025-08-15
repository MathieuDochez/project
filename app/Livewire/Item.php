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

    protected $listeners = ['filtersChanged' => 'updateFilters', 'basket-updated' => 'updateBasketView'];

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

    public function updateBasketView()
    {
        $this->basketItems = Cart::getItems();
    }

    // RENAMED: Changed from addToBasket to addToCart (no forwarding needed!)
    public function addToCart(ItemModel $item)
    {
        // CHECK 1: Verify item is in stock
        if ($item->stock <= 0) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Sorry, <b><i>{$item->name}</i></b> is currently out of stock.",
            ]);
            return;
        }

        // CHECK 2: Check if adding one more would exceed available stock
        $currentQtyInCart = Cart::getOneItem($item->id)['qty'] ?? 0;
        $newTotalQty = $currentQtyInCart + 1;

        if ($newTotalQty > $item->stock) {
            $this->dispatch('swal:toast', [
                'background' => 'error',
                'html' => "Cannot add more <b><i>{$item->name}</i></b>. Only {$item->stock} available in stock (you already have {$currentQtyInCart} in your cart).",
            ]);
            return;
        }

        // If validation passes, add to cart
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
                $query->byCategory(ProductCategory::from($this->categoryFilter));
            })
            ->when($this->minPrice, function ($query) {
                $query->where('price', '>=', $this->minPrice);
            })
            ->when($this->maxPrice, function ($query) {
                $query->where('price', '<=', $this->maxPrice);
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(12);
    }

    #[Layout('layouts.project', ['title' => 'Dog store', 'description' => 'Our store with dog products'])]
    public function render()
    {
        $this->updateBasketView();

        $items = $this->getItemsProperty();

        // Create filter configuration
        $categories = [];
        try {
            if (class_exists('App\Enums\ProductCategory')) {
                $categories = collect(ProductCategory::cases())->mapWithKeys(function ($case) {
                    $value = $case->value ?? $case->name;
                    $label = ucfirst(str_replace('_', ' ', $value));
                    return [$value => $label];
                })->toArray();
            }
        } catch (\Exception $e) {
            $categories = [
                'food' => 'Food',
                'toys' => 'Toys',
                'accessories' => 'Accessories',
                'beds' => 'Beds',
                'grooming' => 'Grooming',
                'clothing' => 'Clothing',
                'housing' => 'Housing'
            ];
        }

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
            'filterConfig' => $filterConfig,
            'basketItems' => $this->basketItems,
        ]);
    }
}
