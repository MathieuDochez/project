<div x-data="{
    selectedRating: @entangle('rating'),
    hoverRating: 0,
    isSubmitting: false
}" class="space-y-6">

    <form wire:submit.prevent="submitReview" @submit="isSubmitting = true">
        <!-- Star Rating Section -->
        <div>
            <label class="block text-lg font-semibold text-gray-800 mb-4">How would you rate your experience?</label>
            <div class="flex items-center space-x-2 mb-4">
                <template x-for="star in [1, 2, 3, 4, 5]" :key="star">
                    <button
                        type="button"
                        @click="selectedRating = star; $wire.set('rating', star)"
                        @mouseenter="hoverRating = star"
                        @mouseleave="hoverRating = 0"
                        class="focus:outline-none transition-transform duration-200 hover:scale-110">
                        <svg
                            class="w-10 h-10 transition-colors duration-200"
                            :class="{
                                'text-yellow-400': star <= (hoverRating || selectedRating),
                                'text-gray-300': star > (hoverRating || selectedRating)
                            }"
                            fill="currentColor"
                            viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </button>
                </template>
            </div>

            <!-- Rating Description -->
            <div class="mb-4">
                <p class="text-sm text-gray-600" x-show="selectedRating === 1">😞 Poor - We're sorry to hear that</p>
                <p class="text-sm text-gray-600" x-show="selectedRating === 2">😐 Fair - We'll work to improve</p>
                <p class="text-sm text-gray-600" x-show="selectedRating === 3">🙂 Good - Thanks for your feedback</p>
                <p class="text-sm text-gray-600" x-show="selectedRating === 4">😊 Very Good - We're glad you enjoyed it</p>
                <p class="text-sm text-gray-600" x-show="selectedRating === 5">🤩 Excellent - Thank you so much!</p>
            </div>

            @error('rating')
            <p class="text-red-600 text-sm mb-4 flex items-center">
                <x-heroicon-o-exclamation-circle class="w-4 h-4 mr-1"/>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Comment Section -->
        <div>
            <label for="comment" class="block text-lg font-semibold text-gray-800 mb-3">
                Tell us about your experience
            </label>
            <div class="relative">
                <textarea
                    wire:model="comment"
                    id="comment"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                    placeholder="Share the details of your experience with The Dog Kennel. What did you love? How can we improve?"></textarea>
                <div class="absolute bottom-3 right-3 text-xs text-gray-400">
                    <span x-text="$wire.comment?.length || 0"></span>/1000
                </div>
            </div>
            @error('comment')
            <p class="text-red-600 text-sm mt-2 flex items-center">
                <x-heroicon-o-exclamation-circle class="w-4 h-4 mr-1"/>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-4">
            <div class="flex items-center space-x-2 text-sm text-gray-600">
                <x-heroicon-o-shield-check class="w-4 h-4 text-green-600"/>
                <span>Your review will be public and help other dog owners</span>
            </div>

            <button
                type="submit"
                :disabled="isSubmitting"
                class="inline-flex items-center px-8 py-3 bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white font-semibold rounded-xl transition duration-200 shadow-lg hover:shadow-xl disabled:cursor-not-allowed">

                <template x-if="!isSubmitting">
                    <div class="flex items-center">
                        <x-heroicon-o-paper-airplane class="w-5 h-5 mr-2"/>
                        <span>Submit Review</span>
                    </div>
                </template>

                <template x-if="isSubmitting">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Submitting...</span>
                    </div>
                </template>
            </button>
        </div>
    </form>

    <!-- Success Animation (you can add this later) -->
    <div x-show="false" x-transition class="text-center py-8">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <x-heroicon-o-check class="w-8 h-8 text-green-600"/>
        </div>
        <h3 class="text-xl font-semibold text-green-800 mb-2">Thank You!</h3>
        <p class="text-green-700">Your review has been submitted successfully.</p>
    </div>
</div>
