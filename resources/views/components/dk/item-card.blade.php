<div x-data="{
    inStock: {{ $item->stock }},
    isHovered: false,
    showDetails: false
}"
     class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 transform hover:-translate-y-2 group">

    <!-- Product Image -->
    <div class="relative overflow-hidden h-64 bg-gray-50"
         @mouseenter="isHovered = true"
         @mouseleave="isHovered = false">
        <img src="{{ asset('storage/img/' . $item->name . '.jpg') }}"
             alt="{{ $item->name }}"
             title="{{ $item->name }}"
             class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjI1NiIgdmlld0JveD0iMCAwIDMwMCAyNTYiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMjU2IiBmaWxsPSIjRkJGQ0ZEIi8+CjxwYXRoIGQ9Ik0xNTAgNjBDMTY2IDYwIDE4MCA3NCAxODAgOTBDMTgwIDEwNiAxNjYgMTIwIDE1MCAxMjBDMTU0IDExNCAxMzAgMTA2IDEzMCA5MEMxMzAgNzQgMTM0IDYwIDE1MCA2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8cGF0aCBkPSJNODAgMTYwQzgwIDE1MCA5MCAxNDAgMTA1IDE0MEgxOTVDMjEwIDE0MCAyMjAgMTUwIDIyMCAxNjBWMTkwSDgwVjE2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8dGV4dCB4PSIxNTAiIHk9IjIyMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzk5QTNBRiIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0cHgiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'">

        <!-- Hover Overlay -->
        <div x-show="isHovered"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end justify-center p-6">
            <button @click="showDetails = !showDetails"
                    class="bg-white/90 backdrop-blur-sm text-green-700 px-4 py-2 rounded-full font-semibold hover:bg-white transition duration-200 shadow-lg">
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

        <!-- Category Badge -->
        @if($item->category)
            <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-green-700 px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
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
            <div class="flex items-center justify-between">
                <div class="text-2xl font-bold text-green-600">
                    €{{ number_format($item->price, 2) }}
                </div>
                <div class="text-sm text-gray-500">
                    per item
                </div>
            </div>
        </div>

        <!-- Expanded Details -->
        <div x-show="showDetails"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-40"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 max-h-40"
             x-transition:leave-end="opacity-0 max-h-0"
             class="border-t border-green-100 pt-4 mb-4 overflow-hidden">
            <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-400">
                <h4 class="text-sm font-semibold text-green-800 mb-2 flex items-center">
                    <x-heroicon-o-information-circle class="w-4 h-4 mr-1"/>
                    Product Details
                </h4>
                <div class="grid grid-cols-2 gap-2 text-xs text-green-700">
                    <div class="flex items-center">
                        <x-heroicon-o-tag class="w-3 h-3 mr-1"/>
                        <span>Premium Quality</span>
                    </div>
                    <div class="flex items-center">
                        <x-heroicon-o-shield-check class="w-3 h-3 mr-1"/>
                        <span>Dog Safe</span>
                    </div>
                    <div class="flex items-center">
                        <x-heroicon-o-truck class="w-3 h-3 mr-1"/>
                        <span>Fast Shipping</span>
                    </div>
                    <div class="flex items-center">
                        <x-heroicon-o-arrow-path class="w-3 h-3 mr-1"/>
                        <span>Easy Returns</span>
                    </div>
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
            <button wire:click="addToBasket({{ $item->id }})"
                    x-bind:class="{
                        'opacity-50 cursor-not-allowed': inStock <= 0,
                        'hover:bg-green-700 hover:shadow-xl hover:-translate-y-0.5': inStock > 0
                    }"
                    :disabled="inStock <= 0"
                    class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg">
                <x-heroicon-o-shopping-bag class="w-4 h-4 mr-2"/>
                <span x-show="inStock > 0">Add to Cart</span>
                <span x-show="inStock <= 0">Out of Stock</span>
            </button>
        </div>
    </div>
</div>
