<div class="p-6 bg-gray-100 rounded-lg shadow-md">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Items</h1>

    <!-- Item List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Item List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Description</th>
                <th class="py-2 px-4 text-left">Price</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($items as $item)
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $item->id }}</td>
                    <td class="py-2 px-4">{{ $item->name }}</td>
                    <td class="py-2 px-4">{{ $item->description }}</td>
                    <td class="py-2 px-4">${{ number_format($item->price, 2) }}</td>
                    <td class="py-2 px-4 text-center">
                        <div class="flex justify-center space-x-4">
                            <button wire:click="editItem({{ $item->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-2">
                                <x-heroicon-s-pencil class="h-4 w-4 text-blue-200"/>
                                <span>Edit</span>
                            </button>
                            <button wire:click="deleteItem({{ $item->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600 flex items-center space-x-2">
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

    <!-- Pagination -->
    <div class="mt-4">
        {{ $items->links() }} <!-- Pagination links -->
    </div>

    <!-- Create / Edit Form Section -->
    <form wire:submit.prevent="{{ $isEditing ? 'updateItem' : 'createItem' }}" class="space-y-6 bg-white p-6 rounded-lg shadow-md mt-8">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input type="text" id="name" wire:model="name" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea id="description" wire:model="description" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"></textarea>
            @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
            <input type="number" id="price" wire:model="price" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" />
            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="flex space-x-4 justify-center">
            <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                {{ $isEditing ? 'Update Item' : 'Create Item' }}
            </button>
            @if($isEditing)
                <button type="button" wire:click="resetForm" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>
            @endif
        </div>
    </form>
</div>
