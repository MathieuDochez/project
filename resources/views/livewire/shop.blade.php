<div>
    <!-- Shop Header -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <x-dk.logo class="w-16 h-16"/>
                <div>
                    <h1 class="text-4xl font-bold mb-2">The Dog Kennel Shop</h1>
                    <p class="text-green-100 text-lg">Premium supplies for your beloved companion</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-green-100 text-sm">{{ count($items) }} {{ Str::plural('product', count($items)) }} available</p>
                <p class="text-2xl font-bold">Quality Guaranteed</p>
            </div>
        </div>
    </div>

    <!-- Shop Stats & Features -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <x-heroicon-o-truck class="w-6 h-6 text-green-600"/>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Free Shipping</h3>
                    <p class="text-gray-600 text-sm">On orders over €50</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <x-heroicon-o-shield-check class="w-6 h-6 text-green-600"/>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Quality Promise</h3>
                    <p class="text-gray-600 text-sm">30-day guarantee</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <x-heroicon-o-heart class="w-6 h-6 text-green-600"/>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-800">Dog Approved</h3>
                    <p class="text-gray-600 text-sm">Tested & loved</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <!-- Products Header -->
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800">Our Products</h2>
                <div class="flex items-center space-x-4">
                    <!-- Future: Add search and filters here -->
                    <div class="text-sm text-gray-600">
                        Showing {{ count($items) }} products
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="p-8">
            @if(count($items) > 0)
                <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-8">
                    @foreach($items as $item)
                        @if($item !== null)
                            <x-dk.item-card :item="$item"/>
                        @endif
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <x-dk.logo class="w-20 h-20 mx-auto mb-4 text-gray-400"/>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Products Available</h3>
                        <p class="text-gray-600 mb-6">Check back later for new products!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Bottom CTA Section -->
    <div class="mt-12 bg-green-50 rounded-2xl p-8 text-center border border-green-200">
        <h3 class="text-2xl font-bold text-green-800 mb-4">Need Help Choosing?</h3>
        <p class="text-green-700 mb-6 max-w-2xl mx-auto">
            Our expert team is here to help you find the perfect products for your dog's needs.
            Contact us for personalized recommendations!
        </p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
            <x-heroicon-o-chat-bubble-left-right class="w-5 h-5 mr-2"/>
            Contact Our Experts
        </a>
    </div>
</div>
