<div>
    {{-- Empty Basket Message --}}
    @if(empty($items))
        <div class="text-center py-16">
            <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-900 mb-4">Your basket is empty</h2>
            <p class="text-gray-600 mb-8">Looks like you haven't added any items to your basket yet. Let's change that!</p>
            <a href="{{ route('shop') }}" class="inline-flex items-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Start Shopping
            </a>
        </div>
    @else
        {{-- Basket Items --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-green-600 px-6 py-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                        </svg>
                        Your Shopping Basket
                    </h2>
                    <span class="bg-white/20 text-white px-3 py-1 rounded-full text-sm font-medium">
                        {{ $totalQty }} items
                    </span>
                </div>
            </div>

            <!-- Items List -->
            <div class="divide-y divide-gray-100">
                @foreach($items as $item)
                    <div class="p-6 hover:bg-gray-50">
                        <div class="flex items-center space-x-6">
                            {{-- Item Image --}}
                            <div class="w-20 h-20 bg-gray-100 rounded-lg overflow-hidden">
                                <img src="{{ asset('storage/img/' . $item['name'] . '.jpg') }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                            </div>

                            {{-- Item Details --}}
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-600 mb-2">{{ $item['description'] }}</p>
                                <div class="flex items-center space-x-4">
                                    <span class="text-lg font-bold text-green-600">€{{ number_format($item['price'], 2) }}</span>
                                </div>
                            </div>

                            {{-- Quantity Controls --}}
                            <div class="flex items-center space-x-3">
                                <button wire:click="decreaseQty({{ $item['id'] }})" class="w-8 h-8 rounded-full bg-gray-200 hover:bg-gray-300 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                    </svg>
                                </button>

                                <div class="w-16 text-center">
                                    <span class="text-lg font-semibold text-gray-900">{{ $item['qty'] }}</span>
                                    <p class="text-xs text-gray-500">Qty</p>
                                </div>

                                <button wire:click="increaseQty({{ $item['id'] }})" class="w-8 h-8 rounded-full bg-green-200 hover:bg-green-300 flex items-center justify-center">
                                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                    </svg>
                                </button>
                            </div>

                            {{-- Total Price --}}
                            <div class="text-right">
                                <div class="text-xl font-bold text-gray-900">
                                    €{{ number_format($item['price'] * $item['qty'], 2) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $item['qty'] }} × €{{ number_format($item['price'], 2) }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Footer -->
            <div class="bg-gray-50 px-6 py-6">
                <div class="flex justify-between items-center">
                    <button wire:click="emptyBasket" onclick="return confirm('Are you sure?')" class="text-red-600 hover:text-red-700 font-medium">
                        Empty Basket
                    </button>

                    <div class="flex items-center space-x-6">
                        <div class="text-right">
                            <p class="text-sm text-gray-600">Total Amount</p>
                            <p class="text-3xl font-bold text-green-600">€{{ number_format($totalPrice, 2) }}</p>
                        </div>

                        @auth
                            <button wire:click="checkoutForm()" class="px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl">
                                Proceed to Checkout
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="px-6 py-3 bg-sky-600 hover:bg-sky-700 text-white font-medium rounded-lg">
                                Login to Continue
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if($showModal)
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto shadow-2xl">
                {{-- Modal Header --}}
                <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6 rounded-t-2xl">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <x-dk.logo class="w-6 h-6 text-white"/>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white">Checkout</h3>
                            <p class="text-green-100">Please provide your shipping information</p>
                        </div>
                    </div>
                </div>

                {{-- Modal Content --}}
                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- Address --}}
                        <div>
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-2">
                                Street Address *
                            </label>
                            <input
                                type="text"
                                id="address"
                                wire:model="form.address"
                                placeholder="123 Main Street"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                            >
                            @error('form.address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- City --}}
                        <div>
                            <label for="city" class="block text-sm font-semibold text-gray-700 mb-2">
                                City *
                            </label>
                            <input
                                type="text"
                                id="city"
                                wire:model="form.city"
                                placeholder="New York"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                            >
                            @error('form.city')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ZIP Code --}}
                        <div>
                            <label for="zip" class="block text-sm font-semibold text-gray-700 mb-2">
                                ZIP Code *
                            </label>
                            <input
                                type="text"
                                id="zip"
                                wire:model="form.zip"
                                placeholder="10001"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                            >
                            @error('form.zip')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Country --}}
                        <div>
                            <label for="country" class="block text-sm font-semibold text-gray-700 mb-2">
                                Country *
                            </label>
                            <input
                                type="text"
                                id="country"
                                wire:model="form.country"
                                placeholder="United States"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                            >
                            @error('form.country')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Notes Field --}}
                    <div class="mb-6">
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">
                            Delivery Notes (Optional)
                        </label>
                        <textarea
                            id="notes"
                            wire:model="form.notes"
                            rows="3"
                            placeholder="Any special delivery instructions..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                        ></textarea>
                        @error('form.notes')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Stock Warnings --}}
                    @if(count($backorder) > 0)
                        <div class="mb-6 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-yellow-500 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
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

                    {{-- Order Summary --}}
                    <div class="bg-gray-50 rounded-lg p-6 mb-6">
                        <h4 class="text-lg font-semibold text-gray-900 mb-4">Order Summary</h4>
                        <div class="flex justify-between items-center text-lg">
                            <span class="text-gray-600">Total ({{ $totalQty }} items):</span>
                            <span class="text-2xl font-bold text-green-600">€{{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="bg-gray-50 px-8 py-6 rounded-b-2xl border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <button
                            wire:click="$set('showModal', false)"
                            class="px-6 py-3 text-gray-600 hover:text-gray-800 font-medium transition duration-200"
                        >
                            Cancel
                        </button>
                        <button
                            wire:click="checkout"
                            class="inline-flex items-center px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition duration-200 shadow-lg hover:shadow-xl"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                            Complete Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
