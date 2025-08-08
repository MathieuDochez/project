{{-- resources/views/livewire/review-form-guest.blade.php --}}
<div class="text-center py-12">
    <div class="max-w-md mx-auto">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <x-heroicon-o-user-circle class="w-10 h-10 text-green-600"/>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Join Our Community</h3>
        <p class="text-gray-600 mb-6">
            We'd love to hear about your experience! Please log in to share your review
            and help other dog owners make informed decisions.
        </p>
        <div class="space-y-3">
            <a href="{{ route('login') }}"
               class="block w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition duration-200 shadow-lg hover:shadow-xl">
                Log In to Review
            </a>
            <a href="{{ route('register') }}"
               class="block w-full px-6 py-3 border border-green-600 text-green-600 hover:bg-green-50 font-semibold rounded-lg transition duration-200">
                Create Account
            </a>
        </div>
        <p class="text-xs text-gray-500 mt-4">
            Don't have an account? It only takes a minute to join our dog-loving community!
        </p>
    </div>
</div>
