<x-project-layout>
    <x-slot name="subtitle"></x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dog Kennel Management Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="grid grid-cols-12 gap-6">
                    <!-- Sidebar -->
                    <div class="col-span-3 bg-gray-800 text-white p-4 rounded-lg shadow-md">
                        <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                        <div class="space-y-2">
                            <x-dropdown-link href="{{ route('dog') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">Editing Dog's</x-dropdown-link>
                            <x-dropdown-link href="{{ route('orders') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">Editing Orders</x-dropdown-link>
                            <x-dropdown-link href="{{ route('items') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">Editing Items</x-dropdown-link>
                            <x-dropdown-link href="{{ route('reviewcrud') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">Editing Reviews</x-dropdown-link>
                            <x-dropdown-link href="{{ route('users') }}" class="text-white hover:bg-gray-600 p-2 rounded-md">Editing Users</x-dropdown-link>
                        </div>
                    </div>

                    <!-- Main Content -->
                    <div class="col-span-9 bg-gray-50 p-6 rounded-lg shadow-md">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-2xl font-bold text-gray-800">Dashboard Overview</h3>
                        </div>
                        <div>
                            <x-welcome />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-project-layout>
