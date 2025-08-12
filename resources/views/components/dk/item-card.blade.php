@props(['item', 'basketItems' => []])

<div
    x-data="{
        showDetails: false,
        inStock: {{ $item->stock }},
        cartQuantity: {{ isset($basketItems[$item->id]) ? $basketItems[$item->id]['qty'] : 0 }},

        // Check if user can add more to cart
        canAddMore() {
            return this.inStock > 0 && this.cartQuantity < this.inStock;
        },

        // Get remaining stock after cart items
        remainingStock() {
            return Math.max(0, this.inStock - this.cartQuantity);
        }
    }"
    class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden relative"
>
    <!-- Product Image & Badges -->
    <div class="relative h-64 bg-gradient-to-br from-green-50 to-green-100 overflow-hidden">
        <!-- Product Image -->
        <div class="absolute inset-0 flex items-center justify-center p-6">
            <img class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300"
                 src="{{ asset('storage/img/' . $item->name . '.jpg') }}"
                 alt="{{ $item->name }}"
                 onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjI1NiIgdmlld0JveD0iMCAwIDMwMCAyNTYiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMjU2IiBmaWxsPSIjRkJGQ0ZEIi8+CjxwYXRoIGQ9Ik0xNTAgNjBDMTY2IDYwIDE4MCA3NCAxODAgOTBDMTgwIDEwNiAxNjYgMTIwIDE1MCAxMjBDMTU0IDExNCAxMzAgMTA2IDEzMCA5MEMxMzAgNzQgMTM0IDYwIDE1MCA2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8cGF0aCBkPSJNODAgMTYwQzgwIDE1MCA5MCAxNDAgMTA1IDE0MEgxOTVDMjEwIDE0MCAyMjAgMTUwIDIyMCAxNjBWMTkwSDgwVjE2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8dGV4dCB4PSIxNTAiIHk9IjIyMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzk5QTNBRiIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0cHgiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'">
        </div>

        <!-- Hover Details Button -->
        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
            <button @click="showDetails = !showDetails"
                    class="px-6 py-3 bg-white/90 backdrop-blur-sm text-gray-800 rounded-lg font-medium hover:bg-white transition duration-200 shadow-lg">
                <span x-show="!showDetails">View Details</span>
                <span x-show="showDetails">Hide Details</span>
            </button>
        </div>

        <!-- Stock Badge -->
        <div class="absolute top-4 left-4">
            <span x-show="inStock > 0"
                  class="bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                <span x-text="inStock"></span> in stock
            </span>
            <span x-show="inStock <= 0"
                  class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                Out of stock
            </span>
        </div>

        <!-- Cart Badge (show if item is in cart) -->
        @if(isset($basketItems[$item->id]) && $basketItems[$item->id]['qty'] > 0)
            <div class="absolute top-4 right-4 bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                {{ $basketItems[$item->id]['qty'] }} in cart
            </div>
        @endif

        <!-- Category Badge -->
        @if($item->category)
            <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm text-green-700 px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                {{ $item->category }}
            </div>
        @endif
    </div>

    <!-- Product Info -->
    <div class="p-6">
        <!-- Main Product Info -->
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-green-600 transition duration-200">
                {{ $item->name }}
            </h3>
            <p class="text-gray-600 text-sm leading-relaxed line-clamp-2 mb-3">
                {{ $item->description }}
            </p>

            <!-- Price -->
            <div class="flex items-center justify-between mb-3">
                <div class="text-2xl font-bold text-green-600">
                    €{{ number_format($item->price, 2) }}
                </div>

                <!-- Stock Info -->
                <div class="text-right">
                    @if(isset($basketItems[$item->id]) && $basketItems[$item->id]['qty'] > 0)
                        <div class="text-xs text-gray-500">
                            {{ max(0, $item->stock - $basketItems[$item->id]['qty']) }} more available
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Product Details (expandable) -->
        <div x-show="showDetails" x-transition class="mb-4 p-4 bg-gray-50 rounded-lg">
            <div class="grid grid-cols-2 gap-4 text-sm">
                <div class="flex items-center">
                    <x-heroicon-o-shield-check class="w-3 h-3 mr-1"/>
                    <span>Quality Assured</span>
                </div>
                <div class="flex items-center">
                    <x-heroicon-o-truck class="w-3 h-3 mr-1"/>
                    <span>Fast Shipping</span>
                </div>
                <div class="flex items-center">
                    <x-heroicon-o-heart class="w-3 h-3 mr-1"/>
                    <span>Pet Approved</span>
                </div>
                <div class="flex items-center">
                    <x-heroicon-o-arrow-path class="w-3 h-3 mr-1"/>
                    <span>Easy Returns</span>
                </div>
            </div>
        </div>

        <!-- Action Button -->
        <div class="flex items-center justify-between">
            <!-- Stock Status -->
            <div class="flex items-center space-x-2">
                @if($item->stock > 0)
                    <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                    <span class="text-sm text-green-600 font-medium">Available</span>
                @else
                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                    <span class="text-sm text-red-600 font-medium">Out of Stock</span>
                @endif
            </div>

            <!-- Add to Cart Button -->
            @php
                $cartQty = isset($basketItems[$item->id]) ? $basketItems[$item->id]['qty'] : 0;
                $canAddMore = $item->stock > 0 && $cartQty < $item->stock;
            @endphp

            <button wire:click="addToBasket({{ $item->id }})"
                    @if(!$canAddMore) disabled @endif
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg
                           @if(!$canAddMore) opacity-50 cursor-not-allowed @else hover:bg-green-700 hover:shadow-xl hover:-translate-y-0.5 @endif">
                <x-heroicon-o-shopping-bag class="w-4 h-4 mr-2"/>

                @if($item->stock <= 0)
                    Out of Stock
                @elseif($cartQty >= $item->stock)
                    Max in Cart
                @else
                    Add to Cart
                @endif
            </button>
        </div>

        <!-- Stock Warning -->
        @php
            $cartQty = isset($basketItems[$item->id]) ? $basketItems[$item->id]['qty'] : 0;
            $remaining = max(0, $item->stock - $cartQty);
        @endphp
        @if($cartQty > 0 && $remaining <= 3 && $remaining > 0)
            <div class="mt-3 p-2 bg-yellow-50 border border-yellow-200 rounded-lg">
                <p class="text-xs text-yellow-700">
                    <x-heroicon-o-exclamation-triangle class="w-3 h-3 inline mr-1"/>
                    Only {{ $remaining }} more available!
                </p>
            </div>
        @endif
    </div>
</div>
