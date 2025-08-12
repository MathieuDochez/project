<div>
    @if(count($items) > 0)
        {{-- Basket Header --}}
        <x-dk.section class="!p-0 !border-0 !shadow-lg rounded-t-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-600 to-green-700 text-white p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z" clip-rule="evenodd"/>
                        </svg>
                        <h2 class="text-2xl font-bold">Your Basket</h2>
                    </div>
                    <div class="text-right">
                        <p class="text-green-100 text-sm">{{ count($items) }} {{ Str::plural('item', count($items)) }}</p>
                        <p class="text-2xl font-bold">€{{ number_format($totalPrice, 2) }}</p>
                    </div>
                </div>
            </div>
        </x-dk.section>

        {{-- Basket Items --}}
        <x-dk.section class="!p-0 !border-0 !shadow-lg rounded-b-2xl overflow-hidden">
            <div class="space-y-0">
                @foreach($items as $item)
                    @php
                        $currentItem = \App\Models\Item::find($item['id']);
                        $canIncrease = $currentItem && $item['qty'] < $currentItem->stock;
                        $isAtMaxStock = $currentItem && $item['qty'] >= $currentItem->stock;
                        $remainingStock = $currentItem ? $currentItem->stock - $item['qty'] : 0;
                    @endphp

                    <div class="flex items-center p-6 border-b border-gray-100 hover:bg-green-50 transition duration-200">
                        {{-- Product Image --}}
                        <div class="flex-shrink-0 mr-6">
                            <div class="w-20 h-20 bg-gray-100 rounded-xl overflow-hidden shadow-md">
                                <img class="w-full h-full object-cover"
                                     src="{{ asset('storage/img/' . $item['name'] . '.jpg') }}"
                                     alt="{{ $item['name'] }}"
                                     onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iODAiIGhlaWdodD0iODAiIHZpZXdCb3g9IjAgMCA4MCA4MCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj4KPHJlY3Qgd2lkdGg9IjgwIiBoZWlnaHQ9IjgwIiBmaWxsPSIjRjNGNEY2Ii8+CjxwYXRoIGQ9Ik00MCAyMEM0NiAyMCA1MCAyNCA1MCAzMEM1MCAzNiA0NiA0MCA0MCA0MEM0NCAzOCAzMCAzNiAzMCAzMEMzMCAyNCAzNCAyMCA0MCAyMFoiIGZpbGw9IiM5Q0EzQUYiLz4KICA8cGF0aCBkPSJNMjAgNTBDMjAgNDUgMjQgNDIgMzAgNDJINTBDNTYgNDIgNjAgNDUgNjAgNTBWNjBIMjBWNTBaIiBmaWxsPSIjOUNBM0FGIi8+Cjwvc3ZnPgo='">
                            </div>
                        </div>

                        {{-- Product Details --}}
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-semibold text-gray-900 mb-1">{{ $item['name'] }}</h3>
                            <p class="text-gray-600 text-sm mb-2 line-clamp-2">{{ $item['description'] }}</p>
                            <div class="flex items-center justify-between">
                                <span class="text-xl font-bold text-green-600">€{{ number_format($item['price'] / $item['qty'], 2) }}</span>
                                <span class="text-sm text-gray-500">Each</span>
                            </div>

                            {{-- Stock Status --}}
                            @if($currentItem)
                                <div class="mt-2 flex items-center space-x-2">
                                    @if($currentItem->stock > 0)
                                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                        <span class="text-xs text-green-600">{{ $currentItem->stock }} total in stock</span>
                                    @else
                                        <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                        <span class="text-xs text-red-600">Out of stock</span>
                                    @endif
                                </div>
                            @endif
                        </div>

                        {{-- Quantity Controls --}}
                        <div class="flex-shrink-0 ml-6">
                            <div class="flex items-center space-x-3">
                                <div class="bg-white border-2 border-gray-200 rounded-lg overflow-hidden shadow-sm">
                                    <div class="flex items-center">
                                        <button wire:click="decreaseQty({{ $item['id'] }})"
                                                class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-red-600 hover:bg-red-50 transition duration-200">
                                            <x-heroicon-o-minus class="w-4 h-4"/>
                                        </button>
                                        <div class="w-12 h-10 flex items-center justify-center font-semibold text-gray-900 bg-gray-50 border-x-2 border-gray-200">
                                            {{ $item['qty'] }}
                                        </div>
                                        <button wire:click="increaseQty({{ $item['id'] }})"
                                                @if(!$canIncrease) disabled @endif
                                                class="w-10 h-10 flex items-center justify-center transition duration-200
                                                       @if($canIncrease) text-gray-600 hover:text-green-600 hover:bg-green-50 @else text-gray-400 cursor-not-allowed opacity-50 @endif">
                                            <x-heroicon-o-plus class="w-4 h-4"/>
                                        </button>
                                    </div>
                                </div>

                                {{-- Stock Info & Subtotal --}}
                                <div class="text-right">
                                    {{-- Stock Status --}}
                                    @if($currentItem)
                                        <div class="text-xs mb-1">
                                            @if($isAtMaxStock)
                                                <span class="text-red-500 font-medium">Max in cart</span>
                                            @elseif($remainingStock <= 3 && $remainingStock > 0)
                                                <span class="text-yellow-600 font-medium">{{ $remainingStock }} more available</span>
                                            @elseif($remainingStock > 0)
                                                <span class="text-gray-500">{{ $remainingStock }} more available</span>
                                            @endif
                                        </div>
                                    @endif

                                    {{-- Subtotal --}}
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="text-lg font-bold text-gray-900">€{{ number_format($item['price'], 2) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Basket Actions --}}
            <div class="bg-gray-50 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center space-y-4 sm:space-y-0">
                    <button wire:click="emptyBasket()"
                            class="inline-flex items-center px-4 py-2 text-red-600 hover:text-red-700 hover:bg-red-50 rounded-lg transition duration-200 font-medium">
                        <x-heroicon-o-trash class="w-4 h-4 mr-2"/>
                        Empty Basket
                    </button>

                    <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Amount</p>
                            <p class="text-3xl font-bold text-green-600">€{{ number_format($totalPrice, 2) }}</p>
                        </div>

                        @auth
                            <button wire:click="checkoutForm()"
                                    class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                                <x-heroicon-o-credit-card class="w-5 h-5 mr-2"/>
                                Proceed to Checkout
                            </button>
                        @else
                            <div class="text-center">
                                <p class="text-gray-600 mb-3">Please login to checkout</p>
                                <a href="{{ route('login') }}"
                                   class="inline-flex items-center px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg transition duration-200">
                                    Login to Continue
                                </a>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </x-dk.section>

        {{-- Stock Warnings --}}
        @if(count($backorder) > 0)
            <x-dk.section class="mt-6">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-400 mt-0.5 mr-3"/>
                        <div>
                            <h3 class="text-sm font-medium text-yellow-800">Stock Notice</h3>
                            <div class="mt-2 text-sm text-yellow-700">
                                <p class="mb-2">Some items in your cart exceed available stock:</p>
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($backorder as $backorderItem)
                                        <li>{{ $backorderItem }}</li>
                                    @endforeach
                                </ul>
                                <p class="mt-2 text-xs">These items will be placed on backorder and shipped when available.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </x-dk.section>
        @endif

    @else
        {{-- Empty Basket --}}
        <x-dk.section>
            <div class="text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l-1 10H6L5 9z"/>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Your basket is empty</h2>
                <p class="text-gray-600 mb-8 max-w-md mx-auto">
                    Discover our amazing selection of premium dog products and start building your perfect order.
                </p>
                <a href="{{ route('shop') }}"
                   class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-xl transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                    <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                    Start Shopping
                </a>
            </div>
        </x-dk.section>
    @endif

    {{-- Enhanced Checkout Modal --}}
    <x-dialog-modal id="checkoutModal" wire:model.live="showModal">
        <x-slot name="title">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" viewBox="0 0 16 16" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 4V7C16 9.20914 14.2091 11 12 11H10V15H0V13L0.931622 10.8706C1.25226 10.9549 1.59036 11 1.9412 11C4.24264 11 6.11765 9.12499 6.11765 6.82353C6.11765 4.52207 4.24264 2.64706 1.9412 2.64706C1.59036 2.64706 1.25226 2.69216 0.931622 2.77647L0 0H6V4H16ZM2 6.82353C2 6.74902 2.06549 6.68353 2.14 6.68353H3.74C3.81451 6.68353 3.88 6.74902 3.88 6.82353C3.88 6.89804 3.81451 6.96353 3.74 6.96353H2.14C2.06549 6.96353 2 6.89804 2 6.82353Z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-900">Checkout</h3>
                    <p class="text-sm text-gray-500">Complete your order details</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                {{-- Order Summary --}}
                <div class="bg-gray-50 rounded-lg p-4">
                    <h4 class="font-semibold text-gray-900 mb-3">Order Summary</h4>
                    <div class="space-y-2">
                        @foreach($items as $item)
                            <div class="flex justify-between text-sm">
                                <span>{{ $item['name'] }} × {{ $item['qty'] }}</span>
                                <span>€{{ number_format($item['price'], 2) }}</span>
                            </div>
                        @endforeach
                        <div class="border-t pt-2 flex justify-between font-semibold">
                            <span>Total</span>
                            <span>€{{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Shipping Information Form --}}
                <div class="space-y-4">
                    <h4 class="font-semibold text-gray-900">Shipping Information</h4>

                    <div>
                        <x-label for="address" value="Address" />
                        <x-input id="address" type="text" wire:model="form.address" class="mt-1 block w-full" />
                        <x-input-error for="form.address" class="mt-2" />
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="city" value="City" />
                            <x-input id="city" type="text" wire:model="form.city" class="mt-1 block w-full" />
                            <x-input-error for="form.city" class="mt-2" />
                        </div>
                        <div>
                            <x-label for="zip" value="ZIP Code" />
                            <x-input id="zip" type="text" wire:model="form.zip" class="mt-1 block w-full" />
                            <x-input-error for="form.zip" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-label for="country" value="Country" />
                        <x-input id="country" type="text" wire:model="form.country" class="mt-1 block w-full" />
                        <x-input-error for="form.country" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="notes" value="Order Notes (Optional)" />
                        <textarea id="notes" wire:model="form.notes" rows="3"
                                  class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Any special delivery instructions..."></textarea>
                        <x-input-error for="form.notes" class="mt-2" />
                    </div>
                </div>

                {{-- Stock Warnings in Modal --}}
                @if(count($backorder) > 0)
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <x-heroicon-o-exclamation-triangle class="w-5 h-5 text-yellow-400 mt-0.5 mr-3"/>
                            <div>
                                <h4 class="text-sm font-medium text-yellow-800">Backorder Notice</h4>
                                <div class="mt-2 text-sm text-yellow-700">
                                    <p class="mb-2">The following items will be backordered:</p>
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach($backorder as $backorderItem)
                                            <li>{{ $backorderItem }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex justify-between w-full">
                <x-secondary-button wire:click="$set('showModal', false)">
                    Cancel
                </x-secondary-button>

                <x-button wire:click="checkout" class="bg-green-600 hover:bg-green-700">
                    <x-heroicon-o-credit-card class="w-4 h-4 mr-2"/>
                    Complete Order
                </x-button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
