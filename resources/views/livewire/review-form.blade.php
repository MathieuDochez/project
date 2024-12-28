<div x-data="{ successMessage: @entangle('success') }">
    <!-- Success message -->
    <div x-show="successMessage" class="alert alert-success mb-4">
        <span x-text="successMessage"></span>
    </div>

    <form wire:submit.prevent="submitReview">
        <div class="mb-4">
            <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
            <select wire:model="rating" id="rating" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
                <option value="">-- Select Rating --</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('rating') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
            <textarea wire:model="comment" id="comment" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
            @error('comment') <span class="text-red-600 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700">Submit</button>
    </form>
</div>
