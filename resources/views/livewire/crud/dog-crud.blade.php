<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false }">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dogs List</h2>

    <!-- Display the list of dogs -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-green-600 text-white">
            <tr>
                <th class="py-3 px-4 text-left font-semibold">Name</th>
                <th class="py-3 px-4 text-left font-semibold">Breed</th>
                <th class="py-3 px-4 text-left font-semibold">Age</th>
                <th class="py-3 px-4 text-left font-semibold">Weight</th>
                <th class="py-3 px-4 text-left font-semibold">Color</th>
                <th class="py-3 px-4 text-left font-semibold">Owner</th>
                <th class="py-3 px-4 text-left font-semibold">Additional Info</th>
                <th class="py-3 px-4 text-center font-semibold">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dogs as $dog)
                <tr class="border-t hover:bg-green-50 transition duration-200">
                    <td class="py-3 px-4 font-medium">{{ $dog->name }}</td>
                    <td class="py-3 px-4">{{ $dog->breed }}</td>
                    <td class="py-3 px-4">{{ $dog->age }}</td>
                    <td class="py-3 px-4">{{ $dog->weight }} kg</td>
                    <td class="py-3 px-4">{{ $dog->color }}</td>
                    <td class="py-3 px-4">{{ $dog->owner }}</td>
                    <td class="py-3 px-4">
                        <div class="max-w-xs">
                            <p class="text-sm text-gray-600 truncate" title="{{ $dog->additional_info }}">
                                {{ $dog->additional_info ?? 'No additional info' }}
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
                                class="px-4 py-2 text-sm font-semibold text-white bg-red-500 rounded-lg hover:bg-red-600 flex items-center space-x-1 transition duration-200">
                                <x-heroicon-s-trash class="h-4 w-4"/>
                                <span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

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
                        placeholder="Enter age in years"
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
                        placeholder="Enter weight in kg"
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
                    @click="showForm = false; $wire.resetForm()"
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
