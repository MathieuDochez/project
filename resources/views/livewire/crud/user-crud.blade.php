<div x-data="{ isEditing: @entangle('isEditing'), name: @entangle('name'), email: @entangle('email'), password: @entangle('password'), showForm: false }" class="p-6 bg-gray-100 rounded-lg shadow-md">
    <!-- Toggle Button -->
    <div class="flex justify-end mb-4">
        <button @click="showForm = !showForm" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            <span x-text="showForm ? 'Hide Form' : 'Show Form'"></span>
        </button>
    </div>

    <!-- User Form (Toggled visibility) -->
    <div x-show="showForm" x-transition class="space-y-6 bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-gray-800 mb-6" x-text="isEditing ? 'Edit User' : 'Create User'"></h1>

        <form wire:submit.prevent="isEditing ? updateUser : createUser" class="space-y-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" x-model="name" wire:model="name" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" x-model="email" wire:model="email" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" x-model="password" wire:model="password" class="w-full mt-1 p-2 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex space-x-4 justify-center">
                <button type="submit" class="px-6 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                    <span x-text="isEditing ? 'Update User' : 'Create User'"></span>
                </button>
                <button x-show="isEditing" @click="name = ''; email = ''; password = ''" type="button" wire:click="resetForm" class="px-6 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Cancel
                </button>
            </div>
        </form>
    </div>

    <!-- Users List -->
    <h2 class="text-xl font-semibold text-gray-800 mt-12 mb-4">Users</h2>
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200 text-gray-600">
            <tr>
                <th class="py-2 px-4 text-left">ID</th>
                <th class="py-2 px-4 text-left">Name</th>
                <th class="py-2 px-4 text-left">Email</th>
                <th class="py-2 px-4 text-left">Status</th>
                <th class="py-2 px-4 text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($users as $user)
                <tr class="border-t hover:bg-gray-100">
                    <td class="py-2 px-4">{{ $user->id }}</td>
                    <td class="py-2 px-4">{{ $user->name }}</td>
                    <td class="py-2 px-4">{{ $user->email }}</td>
                    <td class="py-2 px-4">
                            <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full
                                {{ $user->active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->active ? 'Active' : 'Inactive' }}
                            </span>
                    </td>
                    <td class="py-2 px-4 text-center">
                        <div class="flex justify-center space-x-4">
                            <button wire:click="editUser({{ $user->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-blue-500 rounded hover:bg-blue-600">
                                Edit
                            </button>
                            <button wire:click="toggleActive({{ $user->id }})" class="px-6 py-1 text-sm font-semibold text-white bg-red-500 rounded hover:bg-red-600">
                                Toggle Status
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
        {{ $users->links() }}
    </div>
</div>
