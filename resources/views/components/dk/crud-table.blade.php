@props([
    'title' => 'Manage Items',
    'items' => collect(),
    'columns' => [],
    'itemName' => 'item',
    'itemNamePlural' => 'items',
    'emptyMessage' => 'No items available at the moment.',
    'hasCreate' => true,
    'createButtonText' => 'Add New Item',
    'showAddButton' => true
])

{{-- Reusable CRUD Table Component --}}
<div class="p-6 bg-gray-100 rounded-lg shadow-md"
     x-data="{ isEditing: @entangle('isEditing'), showForm: false }">

    <!-- Page Title -->
    <h1 class="text-2xl font-bold text-gray-800 mb-6">{{ $title }}</h1>

    <!-- List Section -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">{{ ucfirst($itemNamePlural) }} List</h2>

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <!-- Table Header -->
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                @foreach($columns as $column)
                    <th class="py-2 px-4 {{ $column['align'] ?? 'text-left' }}">
                        {{ $column['label'] }}
                    </th>
                @endforeach
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>

            <!-- Table Body -->
            @if($items && $items->count() > 0)
                <tbody>
                @foreach ($items as $item)
                    <tr class="border-t hover:bg-gray-100">
                        @foreach($columns as $column)
                            <td class="py-2 px-4">
                                @if(isset(${'column_' . $column['key']}))
                                    {{ ${'column_' . $column['key']} }}
                                @else
                                    {{ data_get($item, $column['key']) }}
                                @endif
                            </td>
                        @endforeach

                        <!-- Actions Column -->
                        <td class="py-2 px-4 text-center">
                            <div class="flex justify-center space-x-4">
                                @if(isset($actions))
                                    {{ $actions }}
                                @else
                                    <!-- Default Edit Button -->
                                    <button
                                        wire:click="edit{{ ucfirst($itemName) }}({{ $item->id }})"
                                        @click="showForm = true"
                                        class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 flex items-center space-x-2">
                                        <x-heroicon-s-pencil class="h-4 w-4 text-blue-200"/>
                                        <span>Edit</span>
                                    </button>

                                    <button
                                        wire:click="delete{{ ucfirst($itemName) }}({{ $item->id }})"
                                        class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600 flex items-center space-x-2">
                                        <x-heroicon-s-trash class="h-4 w-4 text-red-200"/>
                                        <span>Delete</span>
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            @else
                <tbody>
                <tr class="border-t hover:bg-gray-100">
                    <td colspan="{{ count($columns) + 1 }}" class="py-2 px-4 text-red-700 text-center">
                        {{ $emptyMessage }}
                    </td>
                </tr>
                </tbody>
            @endif
        </table>
    </div>

    <!-- Pagination -->
    @if($items && method_exists($items, 'links'))
        <div class="mt-4">
            {{ $items->links() }}
        </div>
    @endif

    <!-- Form Section -->
    <div x-show="showForm" @keydown.escape="showForm = false" x-transition>
        {{ $slot }}
    </div>

    <!-- Add Button -->
    @if($hasCreate && $showAddButton)
        <div x-show="!showForm" class="mt-6">
            <button @click="showForm = true"
                    class="px-6 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 flex items-center space-x-2">
                <x-heroicon-s-plus class="h-4 w-4"/>
                <span>{{ $createButtonText }}</span>
            </button>
        </div>
    @endif
</div>
