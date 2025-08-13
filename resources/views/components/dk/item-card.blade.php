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
                 src="{{ $item->image_url }}"
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

        <!-- Price Badge -->
        <div class="absolute bottom-4 right-4 bg-white/90 backdrop-blur-sm text-green-700 px-3 py-2 rounded-lg font-bold shadow-lg">
            {{ $item->formatted_price }}
        </div>
    </div>

    <!-- Product Info -->
    <div class="p-6">
        <!-- Basic Info -->
        <div class="mb-4">
            <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-1">{{ $item->name }}</h3>
            <p class="text-gray-600 text-sm line-clamp-2">{{ $item->description }}</p>
        </div>

        <!-- Category & Stock -->
        <div class="flex items-center justify-between mb-4">
            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                {{ $item->category->value }}
            </span>
            <div class="flex items-center text-sm text-gray-500">
                <div class="w-2 h-2 rounded-full mr-2"
                     :class="inStock > 0 ? 'bg-green-500' : 'bg-red-500'"></div>
                <span x-text="inStock + ' available'"></span>
            </div>
        </div>

        <!-- Extended Details -->
        <div x-show="showDetails"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform scale-95"
             x-transition:enter-end="opacity-100 transform scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform scale-100"
             x-transition:leave-end="opacity-0 transform scale-95"
             class="mb-4 pt-4 border-t border-gray-200">

            <!-- Cart Status -->
            <div x-show="cartQuantity > 0" class="mb-3 p-3 bg-blue-50 rounded-lg">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-blue-800">In your basket:</span>
                    <span class="font-semibold text-blue-900" x-text="cartQuantity + ' items'"></span>
                </div>
                <div class="text-xs text-blue-600 mt-1">
                    <span x-text="remainingStock()"></span> more available
                </div>
            </div>

            <!-- Stock Warning -->
            <div x-show="cartQuantity > 0 && remainingStock() <= 5 && remainingStock() > 0"
                 class="mb-3 p-2 bg-amber-50 border border-amber-200 rounded-lg">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-amber-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span class="text-xs text-amber-800">
                        Only <span x-text="remainingStock()"></span> left!
                    </span>
                </div>
            </div>
        </div>

        <!-- Add to Cart Button -->
        <button @click="$wire.addToCart({{ $item->id }})"
                :disabled="!canAddMore()"
                :class="{
                    'bg-green-600 hover:bg-green-700 text-white': canAddMore(),
                    'bg-gray-300 text-gray-500 cursor-not-allowed': !canAddMore()
                }"
                class="w-full font-semibold py-3 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
            <span x-show="canAddMore()">Add to Basket</span>
            <span x-show="!canAddMore() && inStock <= 0">Out of Stock</span>
            <span x-show="!canAddMore() && inStock > 0 && cartQuantity >= inStock">Max Quantity Reached</span>
        </button>
    </div>
</div>
