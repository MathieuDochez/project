{{-- resources/views/livewire/basket.blade.php --}}
<div class="space-y-6">
    @if(count($items) === 0)
        {{-- Empty Basket State --}}
        <x-dk.section class="text-center py-16 bg-gradient-to-br from-green-50 to-sky-50 border-2 border-dashed border-green-200">
            <div class="flex flex-col items-center space-y-4">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center">
                    <x-heroicon-o-shopping-bag class="w-12 h-12 text-green-600"/>
                </div>
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Your basket is empty</h3>
                    <p class="text-gray-600 mb-6">Add some items to get started!</p>
                    <a href="{{ route('shop') }}"
                       class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                        <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                        Start Shopping
                    </a>
                </div>
            </div>
        </x-dk.section>
    @else
        {{-- Basket Header --}}
        <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-t-2xl px-6 py-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8" viewBox="0 0 16 16" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 4V7C16 9.20914 14.2091 11 12 11H10V15H0V13L0.931622 10.8706C1.25226 10.9549 1.59036 11 1.94124 11C3.74931 11 5.32536 9.76947 5.76388 8.01538L3.82359 7.53031C3.60766 8.39406 2.83158 9.00001 1.94124 9.00001C1.87789 9.00001 1.81539 8.99702 1.75385 8.99119C1.02587 8.92223 0.432187 8.45551 0.160283 7.83121C0.0791432 7.64491 0.0266588 7.44457 0.00781272 7.23658C-0.0112323 7.02639 0.00407892 6.80838 0.0588889 6.58914C0.0588882 6.58914 0.0588896 6.58913 0.0588889 6.58914L0.698705 4.02986C1.14387 2.24919 2.7438 1 4.57928 1H10L12 4H16ZM9 6C9.55229 6 10 5.55228 10 5C10 4.44772 9.55229 4 9 4C8.44771 4 8 4.44772 8 5C8 5.55228 8.44771 6 9 6Z"/>
                    </svg>
                    <h2 class="text-2xl font-bold">Your Basket</h2>
                </div>
                <div class="text-right">
                    <p class="text-green-100 text-sm">{{ count($items) }} {{ Str::plural('item', count($items)) }}</p>
                    <p class="text-2xl font-bold">€{{ number_format($totalPrice, 2) }}</p>
                </div>
            </div>
        </div>

        {{-- Basket Items --}}
        <x-dk.section class="!p-0 !border-0 !shadow-lg rounded-b-2xl overflow-hidden">
            <div class="space-y-0">
                @foreach($items as $item)
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
                                <span class="text-xl font-bold text-green-600">€{{ number_format($item['price'], 2) }}</span>
                                <span class="text-sm text-gray-500">Each</span>
                            </div>
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
                                                class="w-10 h-10 flex items-center justify-center text-gray-600 hover:text-green-600 hover:bg-green-50 transition duration-200">
                                            <x-heroicon-o-plus class="w-4 h-4"/>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Subtotal</p>
                                    <p class="text-lg font-bold text-gray-900">€{{ number_format($item['price'] * $item['qty'], 2) }}</p>
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
    @endif

    {{-- Enhanced Checkout Modal --}}
    <x-dialog-modal id="checkoutModal" wire:model.live="showModal">
        <x-slot name="title">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" viewBox="0 0 16 16" fill="currentColor">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M16 4V7C16 9.20914 14.2091 11 12 11H10V15H0V13L0.931622 10.8706C1.25226 10.9549 1.59036 11 1.94124 11C3.74931 11 5.32536 9.76947 5.76388 8.01538L3.82359 7.53031C3.60766 8.39406 2.83158 9.00001 1.94124 9.00001C1.87789 9.00001 1.81539 8.99702 1.75385 8.99119C1.02587 8.92223 0.432187 8.45551 0.160283 7.83121C0.0791432 7.64491 0.0266588 7.44457 0.00781272 7.23658C-0.0112323 7.02639 0.00407892 6.80838 0.0588889 6.58914C0.0588882 6.58914 0.0588896 6.58913 0.0588889 6.58914L0.698705 4.02986C1.14387 2.24919 2.7438 1 4.57928 1H10L12 4H16ZM9 6C9.55229 6 10 5.55228 10 5C10 4.44772 9.55229 4 9 4C8.44771 4 8 4.44772 8 5C8 5.55228 8.44771 6 9 6Z"/>
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Checkout</h2>
                    <p class="text-gray-600">Complete your order from The Dog Kennel</p>
                </div>
            </div>
        </x-slot>

        <x-slot name="content">
            <div class="space-y-6">
                {{-- Order Summary --}}
                <div class="bg-green-50 rounded-lg p-4 border border-green-200">
                    <h3 class="font-semibold text-green-800 mb-2">Order Summary</h3>
                    <div class="flex justify-between text-sm text-green-700">
                        <span>{{ count($items) }} {{ Str::plural('item', count($items)) }}</span>
                        <span class="font-bold">€{{ number_format($totalPrice, 2) }}</span>
                    </div>
                </div>

                {{-- Shipping Information --}}
                <div>
                    <div class="flex items-center space-x-2 mb-4">
                        <x-heroicon-o-map-pin class="w-5 h-5 text-green-600"/>
                        <h3 class="text-lg font-semibold text-gray-900">Shipping Address</h3>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <x-label for="address" value="Street Address" class="text-gray-700 font-medium"/>
                            <x-input id="address" type="text"
                                     class="block w-full mt-1 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                                     wire:model.blur="form.address"
                                     placeholder="Enter your street address"/>
                            <x-input-error for="form.address" class="mt-2"/>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <x-label for="city" value="City" class="text-gray-700 font-medium"/>
                                <x-input id="city" type="text"
                                         class="block w-full mt-1 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                                         wire:model.blur="form.city"
                                         placeholder="City"/>
                                <x-input-error for="form.city" class="mt-2"/>
                            </div>
                            <div>
                                <x-label for="zip" value="ZIP Code" class="text-gray-700 font-medium"/>
                                <x-input id="zip" type="text"
                                         class="block w-full mt-1 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                                         wire:model.blur="form.zip"
                                         placeholder="ZIP Code"/>
                                <x-input-error for="form.zip" class="mt-2"/>
                            </div>
                        </div>

                        <div>
                            <x-label for="country" value="Country" class="text-gray-700 font-medium"/>
                            <x-input id="country" type="text"
                                     class="block w-full mt-1 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                                     wire:model.blur="form.country"
                                     placeholder="Country"/>
                            <x-input-error for="form.country" class="mt-2"/>
                        </div>

                        <div>
                            <x-label for="notes" value="Order Notes (Optional)" class="text-gray-700 font-medium"/>
                            <x-dk.form.textarea id="notes" name="notes" rows="3"
                                                wire:model.blur="form.notes"
                                                class="w-full mt-1 border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg"
                                                placeholder="Any special instructions for your order..."/>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <div class="flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 w-full">
                <button @click="$wire.showModal = false"
                        class="w-full sm:w-auto px-6 py-2 text-gray-600 hover:text-gray-800 hover:bg-gray-100 rounded-lg transition duration-200 font-medium">
                    Cancel
                </button>

                <div class="flex items-center space-x-4">
                    <div class="text-right">
                        <p class="text-sm text-gray-600">Total</p>
                        <p class="text-xl font-bold text-green-600">€{{ number_format($totalPrice, 2) }}</p>
                    </div>
                    <button wire:click="checkout()"
                            class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                        Place Order
                    </button>
                </div>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>
