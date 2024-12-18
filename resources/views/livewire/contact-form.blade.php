<div class="max-w-3xl mx-auto p-8 bg-white shadow-lg rounded-lg">
    <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Contact Us</h1>

    <form wire:submit.prevent="sendEmail" class="space-y-6">
        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input
                type="text"
                id="name"
                wire:model="name"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Your name"
            >
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                id="email"
                wire:model="email"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Your email"
            >
        </div>

        <!-- Message Field -->
        <div>
            <label for="message" class="block text-sm font-medium text-gray-700">Message</label>
            <textarea
                id="message"
                wire:model="message"
                rows="4"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Your message"
            ></textarea>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="px-6 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
            >
                Send
            </button>
        </div>
    </form>

    <!-- Success Message -->
    @if(session()->has('success'))
        <div class="mt-6 p-4 bg-green-100 text-green-800 rounded-md">
            {{ session()->get('success') }}
        </div>
    @endif
</div>
