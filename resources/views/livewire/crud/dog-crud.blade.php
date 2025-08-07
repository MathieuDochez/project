{{-- Dog CRUD using reusable dk components --}}
<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false }">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Dogs</h1>

    <!-- Dog List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Dogs List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Breed</th>
                <th class="py-2 px-4 text-left">Age</th>
                <th class="py-2 px-4 text-left">Weight</th>
                <th class="py-2 px-4 text-left">Color</th>
                <th class="py-2 px-4 text-left">Owner</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @if($dogs && $dogs->count() > 0)
                @foreach($dogs as $dog)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $dog->id }}</td>
                        <td class="py-2 px-4">{{ $dog->name }}</td>
                        <td class="py-2 px-4">{{ $dog->breed }}</td>
                        <td class="py-2 px-4">{{ $dog->age }}</td>
                        <td class="py-2 px-4">{{ $dog->weight }} kg</td>
                        <td class="py-2 px-4">{{ $dog->color }}</td>
                        <td class="py-2 px-4">{{ $dog->owner }}</td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-4">
                                <button
                                    wire:click="editDog({{ $dog->id }})"
                                    @click="showForm = true"
                                    class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-2">
                                    <x-heroicon-s-pencil class="h-4 w-4 text-blue-200"/>
                                    <span>Edit</span>
                                </button>

                                <button
                                    wire:click="deleteDog({{ $dog->id }})"
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
                    <td colspan="8" class="py-2 px-4 text-red-700 text-center">No dogs available at the moment.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>

    <!-- Form Section using DK Component -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition>
        <x-dk.crud-form
            :title="$isEditing ? 'Edit Dog' : 'Add Dog'"
            :is-editing="$isEditing"
            :submit-action="$isEditing ? 'updateDog' : 'createDog'"
            :submit-text="$isEditing ? 'Update Dog' : 'Add Dog'">

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" wire:model="name"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="breed" class="block text-sm font-medium text-gray-700">Breed</label>
                <input type="text" id="breed" wire:model="breed"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                @error('breed') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="age" class="block text-sm font-medium text-gray-700">Age (years)</label>
                    <input type="number" id="age" wire:model="age" min="0" max="25"
                           class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="weight" class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                    <input type="number" id="weight" wire:model="weight" step="0.1" min="0"
                           class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                    @error('weight') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="color" class="block text-sm font-medium text-gray-700">Color</label>
                <input type="text" id="color" wire:model="color"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                @error('color') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="owner" class="block text-sm font-medium text-gray-700">Owner</label>
                <input type="text" id="owner" wire:model="owner"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
                @error('owner') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </x-dk.crud-form>
    </div>

    <!-- Add Dog Button -->
    <div x-show="!showForm" class="mt-6">
        <button @click="showForm = true" class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 flex items-center space-x-2">
            <x-heroicon-s-plus class="h-4 w-4"/>
            <span>Add New Dog</span>
        </button>
    </div>
</div>
