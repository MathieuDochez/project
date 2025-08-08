<div>
    <form wire:submit.prevent="sendEmail" class="space-y-6">
        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="text-orange-600">👤</span> Your Name *
            </label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 @error('name') border-red-500 @enderror"
                placeholder="Enter your full name"
            >
            @error('name')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="text-orange-600">📧</span> Email Address *
            </label>
            <input
                type="email"
                id="email"
                wire:model="email"
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 @error('email') border-red-500 @enderror"
                placeholder="Enter your email address"
            >
            @error('email')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                <span class="text-orange-600">💬</span> Your Message *
            </label>
            <textarea
                id="message"
                wire:model="message"
                rows="5"
                class="w-full px-4 py-3 border-2 border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-orange-500 focus:border-orange-500 transition-colors duration-200 resize-none @error('message') border-red-500 @enderror"
                placeholder="Tell us how we can help you and your furry friend..."
            ></textarea>
            @error('message')
            <p class="mt-1 text-sm text-red-600 flex items-center">
                <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                {{ $message }}
            </p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="pt-4">
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold py-4 px-6 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center space-x-2"
                wire:loading.attr="disabled"
                wire:loading.class="opacity-75 cursor-not-allowed"
            >
                <span wire:loading.remove>
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                </span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                <span wire:loading.remove>Send Message</span>
                <span wire:loading>Sending...</span>
            </button>
        </div>

        <!-- Required Fields Note -->
        <p class="text-sm text-gray-500 text-center">
            * Required fields
        </p>
    </form>

    <!-- Success Message with Enhanced Styling -->
    @if(session()->has('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-init="setTimeout(() => show = false, 5000)"
            x-transition.duration.300ms
            class="mt-6 p-6 bg-gradient-to-r from-green-50 to-emerald-50 border-2 border-green-200 rounded-lg shadow-lg"
        >
            <div class="flex items-center space-x-3">
                <div class="bg-green-100 p-2 rounded-full">
                    <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-green-800 font-semibold">Message Sent Successfully! 🐕</h4>
                    <p class="text-green-700 text-sm mt-1">{{ session()->get('success') }}</p>
                </div>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Email Validation Error (if exists) -->
    @if(session()->has('error'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition.duration.300ms
            class="mt-6 p-6 bg-gradient-to-r from-red-50 to-pink-50 border-2 border-red-200 rounded-lg shadow-lg"
        >
            <div class="flex items-center space-x-3">
                <div class="bg-red-100 p-2 rounded-full">
                    <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-red-800 font-semibold">Oops! Something went wrong</h4>
                    <p class="text-red-700 text-sm mt-1">{{ session()->get('error') }}</p>
                </div>
                <button @click="show = false" class="text-red-600 hover:text-red-800">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    @endif
</div>
