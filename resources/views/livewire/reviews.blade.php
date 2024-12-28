<div x-data="{ isAuthenticated: @json(auth()->check()) }" class="container mx-auto p-4">
    <div x-show="isAuthenticated">
        <!-- Only show the form if the user is logged in -->
        @livewire('review-form')
    </div>

    <div x-show="!isAuthenticated">
        <!-- Display a message if the user is not logged in -->
        <p>Please <a href="{{ route('login') }}" class="text-blue-600">log in</a> to submit a review.</p>
    </div>

    <hr class="my-6">

    <div>
        @foreach($reviews as $review)
            <div class="mb-4 p-4 border rounded-md shadow">
                <h3 class="text-lg font-bold">Rating: {{ $review->rating }} / 5</h3>
                <p>{{ $review->comment }}</p>
                <small class="text-gray-500">
                    {{ $review->user ? 'By ' . $review->user->name : 'By Guest' }}
                </small>
            </div>
        @endforeach
    </div>

    <div class="mt-4">
        <div x-data="{ currentPage: @entangle('reviews.current_page') }">
            <!-- Pagination links -->
            {{ $reviews->links() }}
        </div>
    </div>
</div>
