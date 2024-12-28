<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false }">
    <h2 class="text-2xl font-bold text-gray-800 mb-6">Dogs List</h2>

    <!-- Display the list of dogs -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
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
            @foreach($dogs as $dog)
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $dog->name }}</td>
                    <td class="py-2 px-4">{{ $dog->breed }}</td>
                    <td class="py-2 px-4">{{ $dog->age }}</td>
                    <td class="py-2 px-4">{{ $dog->weight }}</td>
                    <td class="py-2 px-4">{{ $dog->color }}</td>
                    <td class="py-2 px-4">{{ $dog->owner }}</td>
                    <td class="py-2 text-center">
                        <div class="flex justify-center space-x-4">
                            <button
                                wire:click="editDog({{ $dog->id }})"
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
            </tbody>
        </table>
    </div>

    <!-- Button to toggle form visibility -->
    <button
        @click="showForm = !showForm"
        class="px-6 py-2 mt-4 bg-green-500 text-white rounded hover:bg-green-600">
        {{ $isEditing ? 'Cancel Edit' : 'Add Dog' }}
    </button>

    <!-- Form for adding/updating a dog -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition class="mt-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">{{ $isEditing ? 'Edit' : 'Add' }} Dog</h3>
        <form wire:submit.prevent="{{ $isEditing ? 'updateDog' : 'createDog' }}" class="space-y-4 bg-white p-6 rounded-lg shadow-md">

            <div>
                <label class="block text-sm font-medium text-gray-700">Name</label>
                <input
                    type="text"
                    wire:model="name"
                    x-model="name"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Breed</label>
                <input
                    type="text"
                    wire:model="breed"
                    x-model="breed"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Age</label>
                <input
                    type="number"
                    wire:model="age"
                    x-model="age"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Weight (kg)</label>
                <input
                    type="number"
                    wire:model="weight"
                    x-model="weight"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Color</label>
                <input
                    type="text"
                    wire:model="color"
                    x-model="color"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Owner</label>
                <input
                    type="text"
                    wire:model="owner"
                    x-model="owner"
                    class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                    required>
            </div>

            <div class="flex items-center space-x-4">
                <button
                    type="submit"
                    class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    {{ $isEditing ? 'Update' : 'Add' }} Dog
                </button>
                <button
                    type="button"
                    wire:click="resetForm"
                    class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
