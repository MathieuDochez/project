@props([
    'title' => 'Form',
    'isEditing' => false,
    'submitAction' => 'save',
    'cancelAction' => 'resetForm',
    'submitText' => 'Save',
    'cancelText' => 'Cancel'
])

{{-- Reusable CRUD Form Component --}}
<h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">{{ $title }}</h3>

<form wire:submit.prevent="{{ $submitAction }}" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
    <!-- Form Fields (passed via slot) -->
    {{ $slot }}

    <!-- Form Actions -->
    <div class="flex space-x-4 justify-center">
        <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
            {{ $submitText }}
        </button>
        <button type="button"
                wire:click="{{ $cancelAction }}"
                @click="showForm = false"
                class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
            {{ $cancelText }}
        </button>
    </div>
</form>
