<div>
    <!-- Custom pagination styling -->
    <style>
        .pagination .page-link {
            @apply px-4 py-2 mx-1 text-green-600 border border-green-300 rounded-lg hover:bg-green-50 transition duration-200;
        }

        .pagination .page-item.active .page-link {
            @apply bg-green-600 text-white border-green-600;
        }

        .pagination .page-item.disabled .page-link {
            @apply text-gray-400 border-gray-300 cursor-not-allowed;
        }
    </style>

    <!-- Order History Header -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <x-dk.logo class="w-16 h-16"/>
                <div>
                    <h1 class="text-4xl font-bold mb-2">Your Order History</h1>
                    <p class="text-green-100 text-lg">Track your purchases and order details</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-green-100 text-sm">{{ $orders->total() }} {{ Str::plural('order', $orders->total()) }}</p>
                <p class="text-2xl font-bold">{{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-shopping-bag class="w-6 h-6 text-green-600"/>
            </div>
            <div class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['total_orders'] }}</div>
            <div class="text-gray-600 text-sm">Total Orders</div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-currency-euro class="w-6 h-6 text-blue-600"/>
            </div>
            <div class="text-2xl font-bold text-gray-800 mb-1">€{{ number_format($stats['total_spent'], 2) }}</div>
            <div class="text-gray-600 text-sm">Total Spent</div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-chart-bar class="w-6 h-6 text-yellow-600"/>
            </div>
            <div class="text-2xl font-bold text-gray-800 mb-1">€{{ number_format($stats['average_order'], 2) }}</div>
            <div class="text-gray-600 text-sm">Average Order</div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-calendar class="w-6 h-6 text-purple-600"/>
            </div>
            <div class="text-2xl font-bold text-gray-800 mb-1">{{ $stats['recent_orders'] }}</div>
            <div class="text-gray-600 text-sm">Last 30 Days</div>
        </div>
    </div>

    <!-- Orders Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800">Order History</h2>
                <div class="text-sm text-gray-600">
                    Showing {{ $orders->firstItem() }} - {{ $orders->lastItem() }} of {{ $orders->total() }} orders
                </div>
            </div>
        </div>

        <div class="p-8">
            @if($orders->count() > 0)
                <div class="space-y-6">
                    @foreach($orders as $order)
                        <div x-data="{ expanded: false }"
                             class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-lg transition duration-200">

                            <!-- Order Header -->
                            <div class="bg-gray-50 p-6 cursor-pointer" @click="expanded = !expanded">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center space-x-4">
                                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                            <x-heroicon-o-shopping-bag class="w-6 h-6 text-green-600"/>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-semibold text-gray-800">
                                                Order #{{ $order->id }}
                                            </h3>
                                            <p class="text-gray-600 text-sm">
                                                {{ $order->created_at->format('F j, Y \a\t g:i A') }}
                                            </p>
                                        </div>
                                    </div>

                                    <div class="flex items-center space-x-4">
                                        <div class="text-right">
                                            <div class="text-2xl font-bold text-green-600">
                                                €{{ number_format($order->getTotalPriceAttribute(), 2) }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $order->orderlines->count() }} {{ Str::plural('item', $order->orderlines->count()) }}
                                            </div>
                                        </div>

                                        <div class="text-gray-400 transition-transform duration-200"
                                             :class="expanded ? 'rotate-180' : ''">
                                            <x-heroicon-o-chevron-down class="w-5 h-5"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Order Details (Expandable) -->
                            <div x-show="expanded"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 max-h-0"
                                 x-transition:enter-end="opacity-100 max-h-96"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 max-h-96"
                                 x-transition:leave-end="opacity-0 max-h-0"
                                 class="overflow-hidden">

                                <div class="p-6 border-t border-gray-200">
                                    <!-- Order Items -->
                                    <h4 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                                        <x-heroicon-o-list-bullet class="w-5 h-5 mr-2 text-green-600"/>
                                        Items in this Order
                                    </h4>

                                    <div class="space-y-4">
                                        @foreach($order->orderlines as $orderline)
                                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                                <div class="flex items-center space-x-4">
                                                    <!-- Item Image Placeholder -->
                                                    <div class="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                                                        <x-heroicon-o-cube class="w-8 h-8 text-green-600"/>
                                                    </div>

                                                    <!-- Item Details -->
                                                    <div>
                                                        <h5 class="font-semibold text-gray-800">{{ $orderline->name }}</h5>
                                                        @if($orderline->description)
                                                            <p class="text-gray-600 text-sm mt-1">{{ $orderline->description }}</p>
                                                        @endif
                                                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500">
                                                            <span>Qty: {{ $orderline->quantity }}</span>
                                                            <span>•</span>
                                                            <span>€{{ number_format($orderline->price, 2) }} each</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Item Total -->
                                                <div class="text-right">
                                                    <div class="text-lg font-semibold text-gray-800">
                                                        €{{ number_format($orderline->price * $orderline->quantity, 2) }}
                                                    </div>
                                                    <div class="text-sm text-gray-500">subtotal</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Order Summary -->
                                    <div class="mt-6 pt-4 border-t border-gray-200">
                                        <div class="flex justify-between items-center text-lg font-semibold">
                                            <span class="text-gray-800">Order Total:</span>
                                            <span class="text-green-600">€{{ number_format($order->getTotalPriceAttribute(), 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <x-heroicon-o-shopping-bag class="w-16 h-16 mx-auto text-gray-400 mb-4"/>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Orders Yet</h3>
                        <p class="text-gray-600 mb-6">You haven't placed any orders yet. Start shopping to see your order history here!</p>
                        <a href="{{ route('shop') }}"
                           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                            <x-heroicon-o-shopping-bag class="w-5 h-5 mr-2"/>
                            Start Shopping
                        </a>
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if($orders->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-gray-50 rounded-xl p-4">
                        {{ $orders->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-green-50 rounded-xl p-6 border border-green-200">
            <h3 class="text-lg font-semibold text-green-800 mb-2">Continue Shopping</h3>
            <p class="text-green-700 mb-4">Discover more premium products for your beloved companion.</p>
            <a href="{{ route('shop') }}"
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200">
                <x-heroicon-o-shopping-bag class="w-4 h-4 mr-2"/>
                Shop Now
            </a>
        </div>

        <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
            <h3 class="text-lg font-semibold text-blue-800 mb-2">Need Help?</h3>
            <p class="text-blue-700 mb-4">Have questions about your orders? We're here to help!</p>
            <a href="{{ route('contact') }}"
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200">
                <x-heroicon-o-chat-bubble-left-right class="w-4 h-4 mr-2"/>
                Contact Us
            </a>
        </div>
    </div>
</div>
