<div x-data="{ showForm: false, isEditing: @entangle('isEditing'), previewImage: null }" class="p-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <x-dk.logo class="mr-4"/>
        Dog Management
    </h2>

    <!-- Dogs Table -->
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
            <tr>
                <th class="py-4 px-6 text-left font-semibold">Image</th>
                <th class="py-4 px-6 text-left font-semibold">Name</th>
                <th class="py-4 px-6 text-left font-semibold">Breed</th>
                <th class="py-4 px-6 text-left font-semibold">Age</th>
                <th class="py-4 px-6 text-left font-semibold">Weight</th>
                <th class="py-4 px-6 text-left font-semibold">Color</th>
                <th class="py-4 px-6 text-left font-semibold">Owner</th>
                <th class="py-4 px-6 text-left font-semibold">Additional Info</th>
                <th class="py-4 px-6 text-center font-semibold">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($dogs as $dog)
                <tr class="hover:bg-green-50 transition duration-200">
                    <!-- Dog Image -->
                    <td class="py-3 px-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-full overflow-hidden shadow-md">
                            <img src="{{ $dog->image_url }}"
                                 alt="{{ $dog->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="font-semibold text-gray-900">{{ $dog->name }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700">{{ $dog->breed }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700">{{ $dog->age }} years</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700">{{ $dog->weight }} kg</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700">{{ $dog->color }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700">{{ $dog->owner ?: 'No owner' }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700 max-w-xs">
                            <p class="truncate">
                                {{ $dog->additional_info ?: 'No additional info' }}
                            </p>
                        </div>
                    </td>
                    <td class="py-3 text-center">
                        <div class="flex justify-center space-x-2">
                            <button
                                wire:click="editDog({{ $dog->id }})"
                                @click="showForm = true"
                                class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 flex items-center space-x-1 transition duration-200">
                                <x-heroicon-s-pencil class="h-4 w-4"/>
                                <span>Edit</span>
                            </button>

                            <button
                                wire:click="deleteDog({{ $dog->id }})"
                                onclick="return confirm('Are you sure you want to delete this dog and its image?')"
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg hover:bg-red-600 flex items-center space-x-1 transition duration-200">
                                <x-heroicon-s-trash class="h-4 w-4"/>
                                <span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                <x-heroicon-o-face-frown class="w-8 h-8 text-gray-400"/>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-700 mb-2">No Dogs Found</h3>
                            <p class="text-gray-500 mb-4">Get started by adding your first dog.</p>
                            <button @click="showForm = true"
                                    class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition duration-200">
                                Add First Dog
                            </button>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($dogs->hasPages())
        <div class="mt-6 flex justify-center">
            <div class="bg-white rounded-lg shadow border border-gray-200 p-4">
                {{ $dogs->links() }}
            </div>
        </div>
    @endif

    <!-- Button to toggle form visibility -->
    <button
        @click="showForm = !showForm; if (!showForm) $wire.resetForm()"
        class="px-6 py-3 mt-6 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 shadow-lg">
        <span x-show="!showForm || !isEditing">Add New Dog</span>
        <span x-show="showForm && !isEditing">Cancel</span>
        <span x-show="showForm && isEditing">Cancel Edit</span>
    </button>

    <!-- Form for adding/updating a dog -->
    <div x-show="showForm" @keydown.escape="showForm = false; $wire.resetForm()" x-transition class="mt-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-6 flex items-center">
            <x-dk.logo class="mr-3"/>
            <span x-show="!isEditing">Add New Dog</span>
            <span x-show="isEditing">Edit Dog</span>
        </h3>

        <form wire:submit.prevent="{{ $isEditing ? 'updateDog' : 'createDog' }}" class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">

            <!-- Image Upload Section -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <label class="block text-sm font-semibold text-gray-700 mb-4">Dog Photo</label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Image (when editing) -->
                    @if($isEditing && $currentImagePath)
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Current Image</h4>
                            <div class="relative">
                                <img src="{{ asset('storage/' . $currentImagePath) }}"
                                     alt="Current dog image"
                                     class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                                <button type="button"
                                        wire:click="removeCurrentImage"
                                        onclick="return confirm('Are you sure you want to remove this image?')"
                                        class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full hover:bg-red-600 transition duration-200 flex items-center justify-center text-xs">
                                    ×
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Upload New Image -->
                    <div>
                        <h4 class="text-sm font-medium text-gray-600 mb-2">
                            @if($isEditing && $currentImagePath) Upload New Image @else Upload Image @endif
                        </h4>

                        <div class="flex items-center justify-center w-full">
                            <label for="image" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition duration-200">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <svg class="w-8 h-8 mb-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                    </svg>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span>
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, WEBP up to 5MB</p>
                                </div>
                                <input id="image" type="file" wire:model="image" accept="image/*" class="hidden"
                                       @change="
                                           if ($event.target.files[0]) {
                                               const reader = new FileReader();
                                               reader.onload = (e) => previewImage = e.target.result;
                                               reader.readAsDataURL($event.target.files[0]);
                                           }
                                       ">
                            </label>
                        </div>

                        <!-- Image Preview -->
                        <div x-show="previewImage" class="mt-4">
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Preview</h4>
                            <img x-bind:src="previewImage" alt="Preview" class="w-32 h-32 object-cover rounded-lg border border-gray-300 shadow-sm">
                        </div>

                        <!-- Upload Progress -->
                        <div wire:loading wire:target="image" class="mt-2">
                            <div class="flex items-center text-sm text-blue-600">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Uploading...
                            </div>
                        </div>

                        @error('image') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Image Info -->
                <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-medium mb-1">Image Guidelines:</p>
                            <ul class="list-disc list-inside space-y-1 text-xs">
                                <li>Images are stored in their original size and quality</li>
                                <li>Filenames are safely generated to prevent conflicts</li>
                                <li>Supported formats: JPG, PNG, WEBP, GIF</li>
                                <li>Maximum file size: 5MB</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dog Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Dog Name *</label>
                    <input
                        type="text"
                        wire:model="name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter dog's name"
                        required>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Breed -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Breed *</label>
                    <input
                        type="text"
                        wire:model="breed"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter breed"
                        required>
                    @error('breed') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Age -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Age (years) *</label>
                    <input
                        type="number"
                        step="0.1"
                        wire:model="age"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter age"
                        required>
                    @error('age') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Weight -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Weight (kg) *</label>
                    <input
                        type="number"
                        step="0.1"
                        wire:model="weight"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter weight"
                        required>
                    @error('weight') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Color -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Color *</label>
                    <input
                        type="text"
                        wire:model="color"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter color"
                        required>
                    @error('color') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Owner -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Owner</label>
                    <input
                        type="text"
                        wire:model="owner"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter owner's name">
                    @error('owner') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Additional Info (full width) -->
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Additional Information</label>
                <textarea
                    wire:model="additional_info"
                    rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200 resize-none"
                    placeholder="Enter any additional information about the dog (medical conditions, special notes, etc.)"></textarea>
                @error('additional_info') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                <button
                    type="button"
                    @click="showForm = false; $wire.resetForm(); previewImage = null"
                    class="px-6 py-2 bg-gray-500 text-white font-semibold rounded-lg hover:bg-gray-600 transition duration-200">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="px-8 py-3 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition duration-200 shadow-lg flex items-center space-x-2">
                    <x-dk.logo class="w-5 h-5"/>
                    <span x-show="!isEditing">Add Dog</span>
                    <span x-show="isEditing">Update Dog</span>
                </button>
            </div>
        </form>
    </div>
</div>
