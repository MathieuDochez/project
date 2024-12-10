<div class="container mx-auto p-4">
    @auth
        <!-- Only show the form if the user is logged in -->
        @livewire('review-form')
    @else
        <!-- Display a message if the user is not logged in -->
        <p>Please <a href="{{ route('login') }}" class="text-blue-600">log in</a> to submit a review.</p>
    @endauth

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
        {{ $reviews->links() }} <!-- Pagination links -->
    </div>
</div>
