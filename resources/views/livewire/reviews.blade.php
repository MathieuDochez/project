<div>
    <!-- Page Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Customer Reviews</h1>
        <p class="text-gray-600">See what our customers are saying about our products and services.</p>
    </div>

    <!-- Rating Statistics Overview -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Rating Overview</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Overall Rating -->
            <div class="text-center">
                <div class="text-3xl font-bold text-blue-600">{{ $ratingStats['average'] }}</div>
                <div class="flex justify-center items-center mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <svg class="w-5 h-5 {{ $i <= round($ratingStats['average']) ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <div class="text-sm text-gray-600">Average Rating</div>
                <div class="text-sm text-gray-500">{{ $ratingStats['total'] }} total reviews</div>
            </div>

            <!-- Rating Breakdown -->
            <div class="col-span-2">
                <h3 class="text-sm font-medium text-gray-700 mb-3">Rating Breakdown</h3>
                @for($i = 5; $i >= 1; $i--)
                    @php
                        $count = $ratingStats['breakdown'][$i] ?? 0;
                        $percentage = $ratingStats['total'] > 0 ? ($count / $ratingStats['total']) * 100 : 0;
                    @endphp
                    <div class="flex items-center mb-2">
                        <span class="text-sm font-medium text-gray-700 w-8">{{ $i }}</span>
                        <svg class="w-4 h-4 text-yellow-400 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <div class="flex-1 bg-gray-200 rounded-full h-2 mr-3">
                            <div class="bg-yellow-400 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                        </div>
                        <span class="text-sm text-gray-600 w-12">{{ $count }}</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- Filter Bar Component -->
    @livewire('components.filter-bar', ['config' => $filterConfig])

    <!-- Reviews List -->
    @if($reviews->count() > 0)
        <div class="space-y-6">
            @foreach($reviews as $review)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <!-- Rating Stars -->
                            <div class="flex items-center mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-5 h-5 {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                                <span class="ml-2 text-sm font-medium text-gray-600">{{ $review->rating }}/5</span>
                            </div>

                            <!-- Review Comment -->
                            <p class="text-gray-800 mb-4 leading-relaxed">{{ $review->comment }}</p>

                            <!-- Review Meta -->
                            <div class="flex items-center text-sm text-gray-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                <span class="mr-4">
                                    @if($review->user)
                                        {{ $review->user->name }}
                                    @else
                                        Guest User
                                    @endif
                                </span>
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                <span>{{ $review->created_at->format('M d, Y') }}</span>
                            </div>
                        </div>

                        <!-- Review Rating Badge -->
                        <div class="ml-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($review->rating >= 4) bg-green-100 text-green-800
                                @elseif($review->rating >= 3) bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $review->rating }} Star{{ $review->rating != 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $reviews->links() }}
        </div>
    @else
        <!-- No Results Found -->
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No reviews found</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if($search || $ratingFilter)
                    No reviews match your current search criteria.
                @else
                    No reviews are currently available.
                @endif
            </p>
        </div>
    @endif

    <!-- Review Form Section -->
    @auth
        <div class="mt-12">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Leave a Review</h3>
                @livewire('review-form')
            </div>
        </div>
    @else
        <div class="mt-12">
            <div class="bg-gray-50 rounded-lg p-6 text-center">
                <h3 class="text-lg font-medium text-gray-800 mb-2">Want to leave a review?</h3>
                <p class="text-gray-600 mb-4">Please log in to share your experience with our products.</p>
                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
                    Log In to Review
                </a>
            </div>
        </div>
    @endauth

    <!-- Loading Indicator -->
    <div wire:loading.flex class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <svg class="animate-spin h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>
</div>
