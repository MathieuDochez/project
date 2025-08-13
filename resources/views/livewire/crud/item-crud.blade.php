<div x-data="{ showForm: false, isEditing: @entangle('isEditing'), previewImage: null }" class="p-6">
    <h2 class="text-3xl font-bold text-gray-800 mb-8 flex items-center">
        <x-dk.logo class="mr-4"/>
        Item Management
    </h2>

    <!-- Items Table -->
    <div class="overflow-x-auto bg-white rounded-xl shadow-lg border border-gray-200">
        <table class="min-w-full">
            <thead class="bg-gradient-to-r from-green-600 to-green-700 text-white">
            <tr>
                <th class="py-4 px-6 text-left font-semibold">Image</th>
                <th class="py-4 px-6 text-left font-semibold">Name</th>
                <th class="py-4 px-6 text-left font-semibold">Description</th>
                <th class="py-4 px-6 text-left font-semibold">Price</th>
                <th class="py-4 px-6 text-left font-semibold">Category</th>
                <th class="py-4 px-6 text-left font-semibold">Stock</th>
                <th class="py-4 px-6 text-center font-semibold">Actions</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
            @forelse($items as $item)
                <tr class="hover:bg-green-50 transition duration-200">
                    <!-- Item Image -->
                    <td class="py-3 px-6">
                        <div class="w-16 h-16 bg-gray-100 rounded-lg overflow-hidden shadow-md">
                            <img src="{{ $item->image_url }}"
                                 alt="{{ $item->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="font-semibold text-gray-900">{{ $item->name }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700 max-w-xs">
                            <p class="truncate">{{ Str::limit($item->description, 50) }}</p>
                        </div>
                    </td>
                    <td class="py-3 px-6">
                        <div class="text-gray-700 font-semibold">{{ $item->formatted_price }}</div>
                    </td>
                    <td class="py-3 px-6">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            {{ ucfirst(str_replace('_', ' ', $item->category->value)) }}
                        </span>
                    </td>
                    <td class="py-3 px-6">
                        <div class="flex items-center">
                            <div class="w-2 h-2 rounded-full mr-2 {{ $item->stock > 0 ? 'bg-green-500' : 'bg-red-500' }}"></div>
                            <span class="text-gray-700">{{ $item->stock }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex items-center justify-center space-x-2">
                            <button wire:click="editItem({{ $item->id }})"
                                    @click="showForm = true"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span>Edit</span>
                            </button>
                            <button wire:click="deleteItem({{ $item->id }})"
                                    onclick="return confirm('Are you sure you want to delete this item?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition duration-200 flex items-center space-x-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                <span>Delete</span>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="py-8 px-6 text-center text-gray-500">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2 2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="text-lg font-medium">No items found</p>
                            <p class="text-sm">Create your first item to get started</p>
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $items->links() }}
    </div>

    <!-- Add Item Button -->
    <div x-show="!showForm" class="mt-8">
        <button @click="showForm = true"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg flex items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
            </svg>
            <span>Add New Item</span>
        </button>
    </div>

    <!-- Create/Edit Form -->
    <div x-show="showForm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform scale-95"
         x-transition:enter-end="opacity-100 transform scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform scale-100"
         x-transition:leave-end="opacity-0 transform scale-95"
         class="mt-8">

        <form wire:submit.prevent="{{ $isEditing ? 'updateItem' : 'createItem' }}" class="bg-white p-8 rounded-xl shadow-lg border border-gray-200">

            <!-- Form Header -->
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl font-bold text-gray-800">
                    {{ $isEditing ? 'Edit Item' : 'Create New Item' }}
                </h3>
                <button type="button" @click="showForm = false; $wire.resetForm()"
                        class="text-gray-400 hover:text-gray-600 transition duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Image Upload Section -->
            <div class="mb-8 p-6 bg-gray-50 rounded-lg border border-gray-200">
                <label class="block text-sm font-semibold text-gray-700 mb-4">Item Photo</label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Current Image (when editing) -->
                    @if($isEditing && $currentImagePath)
                        <div>
                            <h4 class="text-sm font-medium text-gray-600 mb-2">Current Image</h4>
                            <div class="relative">
                                <img src="{{ asset('storage/' . $currentImagePath) }}"
                                     alt="Current item image"
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
            </div>

            <!-- Item Information -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Item Name *</label>
                    <input
                        type="text"
                        wire:model="name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="Enter item name"
                        required>
                    @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Price (€) *</label>
                    <input
                        type="number"
                        step="0.01"
                        wire:model="price"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="0.00"
                        required>
                    @error('price') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <select
                        wire:model="category"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        required>
                        <option value="">Select Category</option>
                        @foreach($this->categories as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>

                <!-- Stock -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock Quantity *</label>
                    <input
                        type="number"
                        wire:model="stock"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                        placeholder="0"
                        min="0"
                        required>
                    @error('stock') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Description *</label>
                <textarea
                    wire:model="description"
                    rows="4"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition duration-200"
                    placeholder="Enter item description"
                    required></textarea>
                @error('description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <!-- Form Actions -->
            <div class="flex items-center justify-end space-x-4 mt-8">
                <button type="button" @click="showForm = false; $wire.resetForm()"
                        class="px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition duration-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white rounded-lg font-semibold transition duration-200 shadow-md hover:shadow-lg">
                    {{ $isEditing ? 'Update Item' : 'Create Item' }}
                </button>
            </div>
        </form>
    </div>
</div>
