<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $isEditing ? 'Edit Review' : 'Create Review' }}</h1>

    <!-- Review Form -->
    <form wire:submit.prevent="{{ $isEditing ? 'updateReview' : 'createReview' }}" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <div>
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
            <input type="number" id="rating" wire:model="rating" min="1" max="5" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
            @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
            <textarea id="comment" wire:model="comment" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4 justify-center">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                {{ $isEditing ? 'Update Review' : 'Create Review' }}
            </button>
            @if($isEditing)
                <button type="button" wire:click="resetForm" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>
            @endif
        </div>
    </form>

    <!-- Reviews List -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Reviews</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">Rating</th>
                <th class="py-2 px-4 text-left">Comment</th>
                <th class="py-2 px-4 text-left">Created At</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reviews as $review)
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $review->rating }}</td>
                    <td class="py-2 px-4">{{ $review->comment }}</td>
                    <td class="py-2 px-4">{{ $review->created_at->format('d M Y') }}</td>
                    <td class="py-2 px-4 text-center">
                        <div class="flex justify-center space-x-4">
                            <button wire:click="editReview({{ $review->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                Edit
                            </button>
                            <button wire:click="deleteReview({{ $review->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $reviews->links() }}
    </div>
</div>
