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

    <!-- Reviews Header -->
    <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-2xl p-8 mb-8 text-white shadow-xl">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <x-dk.logo class="w-16 h-16"/>
                <div>
                    <h1 class="text-4xl font-bold mb-2">Customer Reviews</h1>
                    <p class="text-green-100 text-lg">See what our community says about The Dog Kennel</p>
                </div>
            </div>
            <div class="text-right">
                @php
                    $avgRating = $reviews->avg('rating') ?? 0;
                    $totalReviews = $reviews->total();
                @endphp
                <div class="flex items-center justify-end mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($avgRating))
                            <x-heroicon-s-star class="w-6 h-6 text-yellow-400"/>
                        @elseif($i <= ceil($avgRating))
                            <x-heroicon-s-star class="w-6 h-6 text-yellow-300"/>
                        @else
                            <x-heroicon-o-star class="w-6 h-6 text-gray-300"/>
                        @endif
                    @endfor
                </div>
                <p class="text-green-100 text-sm">{{ number_format($avgRating, 1) }} out of 5 stars</p>
                <p class="text-2xl font-bold">{{ $totalReviews }} {{ Str::plural('review', $totalReviews) }}</p>
            </div>
        </div>
    </div>

    <!-- Trust Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-shield-check class="w-8 h-8 text-green-600"/>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Verified Reviews</h3>
            <p class="text-gray-600 text-sm">All reviews from real customers</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-heart class="w-8 h-8 text-green-600"/>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Dog Owner Approved</h3>
            <p class="text-gray-600 text-sm">Reviews by fellow dog lovers</p>
        </div>

        <div class="bg-white rounded-xl p-6 shadow-lg border border-green-100 text-center">
            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <x-heroicon-o-star class="w-8 h-8 text-green-600"/>
            </div>
            <h3 class="font-semibold text-gray-800 mb-2">Quality Focused</h3>
            <p class="text-gray-600 text-sm">Honest feedback helps us improve</p>
        </div>
    </div>

    <!-- Review Form Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden mb-8">
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center">
                <x-heroicon-o-pencil class="w-6 h-6 mr-3 text-green-600"/>
                Share Your Experience
            </h2>
            <p class="text-gray-600 mt-2">Help other dog owners by sharing your experience with The Dog Kennel</p>
        </div>

        <div class="p-8">
            <div x-data="{ isAuthenticated: @json(auth()->check()) }">
                <div x-show="isAuthenticated">
                    @livewire('review-form')
                </div>

                <div x-show="!isAuthenticated" class="text-center py-12">
                    <div class="max-w-md mx-auto">
                        <x-heroicon-o-user-circle class="w-16 h-16 mx-auto text-gray-400 mb-4"/>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Join Our Community</h3>
                        <p class="text-gray-600 mb-6">Please log in to share your experience and help other dog owners make informed decisions.</p>
                        <a href="{{ route('login') }}"
                           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                            <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5 mr-2"/>
                            Log In to Review
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Reviews Section -->
    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-8 py-6 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-800">Customer Reviews</h2>
                <div class="text-sm text-gray-600">
                    Showing {{ $reviews->count() }} of {{ $reviews->total() }} reviews
                </div>
            </div>
        </div>

        <div class="p-8">
            @if($reviews->count() > 0)
                <div class="space-y-6">
                    @foreach($reviews as $review)
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200 hover:shadow-lg transition duration-200">
                            <!-- Review Header -->
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-4">
                                    <!-- User Avatar -->
                                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-700 font-semibold text-lg">
                                            {{ strtoupper(substr($review->user ? $review->user->name : 'Guest', 0, 1)) }}
                                        </span>
                                    </div>
                                    <!-- User Info -->
                                    <div>
                                        <h4 class="font-semibold text-gray-800">
                                            {{ $review->user ? $review->user->name : 'Guest User' }}
                                        </h4>
                                        <p class="text-gray-500 text-sm">{{ $review->created_at->format('M j, Y') }}</p>
                                    </div>
                                </div>

                                <!-- Rating -->
                                <div class="flex items-center space-x-2">
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <x-heroicon-s-star class="w-5 h-5 text-yellow-400"/>
                                            @else
                                                <x-heroicon-o-star class="w-5 h-5 text-gray-300"/>
                                            @endif
                                        @endfor
                                    </div>
                                    <span class="text-sm font-medium text-gray-600">{{ $review->rating }}/5</span>
                                </div>
                            </div>

                            <!-- Review Content -->
                            <div class="ml-16">
                                <p class="text-gray-700 leading-relaxed">{{ $review->comment }}</p>

                                <!-- Review Actions (if needed) -->
                                <div class="mt-4 flex items-center space-x-4 text-sm text-gray-500">
                                    <button class="flex items-center space-x-1 hover:text-green-600 transition duration-200">
                                        <x-heroicon-o-hand-thumb-up class="w-4 h-4"/>
                                        <span>Helpful</span>
                                    </button>
                                    <span class="text-gray-300">•</span>
                                    <button class="hover:text-green-600 transition duration-200">
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16">
                    <div class="max-w-md mx-auto">
                        <x-heroicon-o-chat-bubble-left-ellipsis class="w-16 h-16 mx-auto text-gray-400 mb-4"/>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">No Reviews Yet</h3>
                        <p class="text-gray-600 mb-6">Be the first to share your experience with The Dog Kennel!</p>
                        @auth
                            <button class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                                <x-heroicon-o-pencil class="w-5 h-5 mr-2"/>
                                Write First Review
                            </button>
                        @endauth
                    </div>
                </div>
            @endif

            <!-- Pagination -->
            @if($reviews->hasPages())
                <div class="mt-8 flex justify-center">
                    <div class="bg-gray-50 rounded-xl p-4">
                        {{ $reviews->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Bottom CTA Section -->
    <div class="mt-12 bg-green-50 rounded-2xl p-8 text-center border border-green-200">
        <h3 class="text-2xl font-bold text-green-800 mb-4">Questions About Our Services?</h3>
        <p class="text-green-700 mb-6 max-w-2xl mx-auto">
            Still have questions? Our friendly team is here to help you and your furry friend
            have the best possible experience with The Dog Kennel.
        </p>
        <a href="{{ route('contact') }}"
           class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
            <x-heroicon-o-envelope class="w-5 h-5 mr-2"/>
            Contact Us
        </a>
    </div>
</div>
