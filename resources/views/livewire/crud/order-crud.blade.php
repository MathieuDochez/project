{{-- Order CRUD with simple rotating arrow --}}
<div class="p-6 bg-gray-100 rounded-lg shadow-md" x-data="{ isEditing: @entangle('isEditing'), showForm: false, expandedOrder: null }">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Manage Orders</h1>

    <!-- Order List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Order List</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left w-12">Details</th>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Client</th>
                <th class="py-2 px-4 text-left">Total Price</th>
                <th class="py-2 px-4 text-left">Order Date</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            @if($orders->count() > 0)
                <tbody>
                @foreach ($orders as $order)
                    <!-- Main Order Row -->
                    <tr class="border-t hover:bg-gray-100">
                        <td class="py-2 px-4 text-center">
                            <button @click="expandedOrder = expandedOrder === {{ $order->id }} ? null : {{ $order->id }}"
                                    class="text-gray-500 hover:text-blue-600 transition-colors p-1">
                                <div x-show="expandedOrder !== {{ $order->id }}">
                                    <x-heroicon-s-chevron-right class="h-4 w-4"/>
                                </div>
                                <div x-show="expandedOrder === {{ $order->id }}">
                                    <x-heroicon-s-chevron-down class="h-4 w-4"/>
                                </div>
                            </button>
                        </td>
                        <td class="py-2 px-4 font-medium">#{{ $order->id }}</td>
                        <td class="py-2 px-4">{{ $order->user ? $order->user->name : 'No User' }}</td>
                        <td class="py-2 px-4 font-semibold">€{{ number_format($order->total_price, 2) }}</td>
                        <td class="py-2 px-4">{{ $order->created_at->format('d M Y H:i') }}</td>
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <button
                                    wire:click="edit({{ $order->id }})"
                                    @click="showForm = true"
                                    class="px-4 py-1 text-xs font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-1">
                                    <x-heroicon-s-pencil class="h-3 w-3"/>
                                    <span>Edit</span>
                                </button>
                                <button
                                    wire:click="delete({{ $order->id }})"
                                    class="px-4 py-1 text-xs font-semibold text-white bg-red-500 rounded hover:bg-red-600 flex items-center space-x-1">
                                    <x-heroicon-s-trash class="h-3 w-3"/>
                                    <span>Delete</span>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Expandable Order Details Row -->
                    <tr x-show="expandedOrder === {{ $order->id }}" x-transition class="bg-gray-50">
                        <td colspan="6" class="px-4 py-3">
                            <div class="bg-white rounded-lg p-4 shadow-sm">
                                <div class="flex items-center mb-3">
                                    <x-heroicon-s-shopping-cart class="h-5 w-5 text-blue-500 mr-2"/>
                                    <h4 class="text-sm font-semibold text-gray-800">Order Items:</h4>
                                </div>
                                @if($order->orderlines && $order->orderlines->count() > 0)
                                    <div class="space-y-2">
                                        @foreach($order->orderlines as $orderline)
                                            <div class="flex justify-between items-center bg-gray-50 rounded p-3 border-l-4 border-blue-500">
                                                <div class="flex items-center">
                                                    <x-heroicon-s-cube class="h-4 w-4 text-gray-400 mr-3"/>
                                                    <div>
                                                        <span class="font-medium text-gray-800">{{ $orderline->name }}</span>
                                                        <p class="text-sm text-gray-600">{{ $orderline->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="text-right">
                                                    <div class="flex items-center text-sm text-gray-600 mb-1">
                                                        <span>{{ $orderline->quantity }} × €{{ number_format($orderline->price, 2) }}</span>
                                                    </div>
                                                    <p class="text-sm font-semibold text-gray-800">€{{ number_format($orderline->quantity * $orderline->price, 2) }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="border-t pt-2 mt-3">
                                            <div class="flex justify-between items-center font-semibold text-gray-800">
                                                <div class="flex items-center">
                                                    <x-heroicon-s-calculator class="h-4 w-4 mr-2"/>
                                                    <span>Order Total:</span>
                                                </div>
                                                <span>€{{ number_format($order->total_price, 2) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center text-red-600">
                                        <x-heroicon-s-exclamation-triangle class="h-4 w-4 mr-2"/>
                                        <p class="text-sm italic">No items in this order (empty order)</p>
                                    </div>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tbody>
                <tr class="border-t hover:bg-gray-100">
                    <td colspan="6" class="py-2 px-4 text-red-700 text-center">No orders available at the moment.</td>
                </tr>
                </tbody>
            @endif
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $orders->links() }}
    </div>

    <!-- Form Section using DK Component -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition>
        <x-dk.crud-form
            :title="'Edit Order'"
            :is-editing="true"
            :submit-action="'update'"
            :submit-text="'Update Order'">

            <div>
                <label for="user_id" class="block text-sm font-medium text-gray-700">Client</label>
                <select id="user_id" wire:model="user_id" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Select Client</option>
                    @foreach(App\Models\User::all() as $user)
                        <option value="{{ $user->id }}" @if($user->id == $user_id) selected @endif>{{ $user->name }}</option>
                    @endforeach
                </select>
                @error('user_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="total_price" class="block text-sm font-medium text-gray-700">Total Price</label>
                <input type="number" id="total_price" wire:model="total_price"
                       class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                       step="0.01" value="{{ old('price', $total_price) }}" />
                @error('total_price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </x-dk.crud-form>
    </div>
</div>
