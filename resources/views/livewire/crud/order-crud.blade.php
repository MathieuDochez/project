<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false, user_id: @entangle('user_id'), total_price: @entangle('total_price') }">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Orders</h1>

    <!-- Order List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Order List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Client</th>
                <th class="py-2 px-4 text-left">Total Price</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            @if(count($orders) > 0)
                <tbody>
                @foreach ($orders as $order)
                    <tr class="border-t hover:bg-gray-100">
                        <td class="py-2 px-4">{{ $order->id }}</td>
                        <td class="py-2 px-4">{{ $order->user ? $order->user->name : 'No User' }}</td>
                        <td class="py-2 px-4">€{{ $order->getTotalPriceAttribute() }}</td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-4">
                                <button
                                    wire:click="edit({{ $order->id }})"
                                    @click="showForm = true"
                                    class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-2">
                                    <x-heroicon-s-pencil class="h-4 w-4 text-blue-200"/>
                                    <span>Edit</span>
                                </button>
                                <button
                                    wire:click="delete({{ $order->id }})"
                                    class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600 flex items-center space-x-2">
                                    <x-heroicon-s-trash class="h-4 w-4 text-red-200"/>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4 text-red-700">No orders available at the moment.</td>
                </tr>
            @endif
        </table>
    </div>

    <!-- Pagination Controls -->
    @if($paginate)
        <div>
            {{ $paginate->links() }}
        </div>
    @endif

    <!-- Edit Form Section (Only visible when editing) -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition>
        <h3 class="text-xl font-semibold text-gray-800 mt-8 mb-4">Edit Order</h3>
        <form wire:submit.prevent="update" class="space-y-6 bg-white p-6 rounded-lg shadow-md">
            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select id="user_id" wire:model="user_id" x-model="user_id" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Client</option>
                    @foreach(App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
                <input type="number" id="total_price" wire:model="total_price" x-model="total_price" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500" step="0.01" value="{{ old('price', $total_price) }}" />
                @error('total_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4 justify-center">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    Update Order
                </button>
                <button type="button" wire:click="resetForm" @click="showForm = false" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</div>
