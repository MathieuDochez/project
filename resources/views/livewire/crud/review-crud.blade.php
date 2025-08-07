{{-- Review CRUD using reusable dk components --}}
<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false }">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Reviews</h1>

    <!-- Review List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Review List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">User</th>
                <th class="py-2 px-4 text-left">Rating</th>
                <th class="py-2 px-4 text-left">Comment</th>
                <th class="py-2 px-4 text-left">Created At</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($reviews && $reviews->count() > 0)
                @foreach ($reviews as $review)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $review->id }}</td>
                        <td class="py-2 px-4">{{ $review->user ? $review->user->name : 'Anonymous' }}</td>
                        <td class="py-2 px-4">
                            <div class="flex items-center">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $review->rating)
                                        <x-heroicon-s-star class="h-4 w-4 text-yellow-400"/>
                                    @else
                                        <x-heroicon-o-star class="h-4 w-4 text-gray-300"/>
                                    @endif
                                @endfor
                                <span class="ml-2 text-sm text-gray-600">({{ $review->rating }}/5)</span>
                            </div>
                        </td>
                        <td class="py-2 px-4">
                            <div class="max-w-xs truncate">{{ $review->comment }}</div>
                        </td>
                        <td class="py-2 px-4">{{ $review->created_at->format('d M Y') }}</td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-4">
                                <button
                                    wire:click="editReview({{ $review->id }})"
                                    @click="showForm = true"
                                    class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-2">
                                    <x-heroicon-s-pencil class="h-4 w-4 text-blue-200"/>
                                    <span>Edit</span>
                                </button>
                                <button
                                    wire:click="deleteReview({{ $review->id }})"
                                    class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600 flex items-center space-x-2">
                                    <x-heroicon-s-trash class="h-4 w-4 text-red-200"/>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-t hover:bg-gray-100">
                    <td colspan="6" class="py-2 px-4 text-red-700 text-center">No reviews available at the moment.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($reviews && method_exists($reviews, 'links'))
        <div class="mt-4">
            {{ $reviews->links() }}
        </div>
    @endif

    <!-- Form Section using DK Component -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition>
        <x-dk.crud-form
            :title="$isEditing ? 'Edit Review' : 'Create Review'"
            :is-editing="$isEditing"
            :submit-action="$isEditing ? 'updateReview' : 'createReview'"
            :submit-text="$isEditing ? 'Update Review' : 'Create Review'">

            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                <select id="rating" wire:model="rating"
                        class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Rating</option>
                    <option value="1">1 Star</option>
                    <option value="2">2 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="5">5 Stars</option>
                </select>
                @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea id="comment" wire:model="comment" rows="4" placeholder="Write your review..."
                          class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></textarea>
                @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </x-dk.crud-form>
    </div>

    <!-- Add Review Button -->
    <div x-show="!showForm" class="mt-6">
        <button @click="showForm = true" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 flex items-center space-x-2">
            <x-heroicon-s-plus class="h-4 w-4"/>
            <span>Add New Review</span>
        </button>
    </div>
</div>
