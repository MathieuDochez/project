<div>
    <!-- Custom pagination styling -->
    <style>
        .pagination .page-link {
            @apply px-4 py-2 mx-1 text-green-600 border border-green-300 rounded-lg hover:bg-green-50 transition duration-200;
        }

        .pagination .page-item.active .page-link {
            @apply bg-green-600 text-white border-green-600;
        }

        .pagination .page-item.disabled .page-link {
            @apply text-gray-400 border-gray-300 cursor-not-allowed;
        }
    </style>

    <div class="container mx-auto p-6">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="flex items-center justify-center mb-4">
                <x-dk.logo class="w-16 h-16 mr-4"/>
                <h1 class="text-4xl font-bold text-gray-800">Our Wonderful Dogs</h1>
            </div>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Meet the amazing dogs staying at The Dog Kennel. Each one has their own personality and story.
            </p>
        </div>

        <!-- Dogs Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach($dogs as $dog)
                <div x-data="{ isHovered: false, showInfo: false }"
                     class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 transform hover:-translate-y-2">

                    <!-- Dog Image -->
                    <div class="relative overflow-hidden h-64"
                         @mouseenter="isHovered = true"
                         @mouseleave="isHovered = false">
                        <img src="{{ asset('storage/img/' . $dog->name . '.jpg') }}"
                             alt="{{ $dog->name }}"
                             class="w-full h-full object-cover object-center transition-transform duration-500"
                             :class="isHovered ? 'scale-110' : 'scale-100'"
                             onerror="this.src='data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMzAwIiBoZWlnaHQ9IjI1NiIgdmlld0JveD0iMCAwIDMwMCAyNTYiIGZpbGw9Im5vbmUiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CjxyZWN0IHdpZHRoPSIzMDAiIGhlaWdodD0iMjU2IiBmaWxsPSIjRkJGQ0ZEIi8+CjxwYXRoIGQ9Ik0xNTAgNjBDMTY2IDYwIDE4MCA3NCAxODAgOTBDMTgwIDEwNiAxNjYgMTIwIDE1MCAxMjBDMTU0IDExNCAxMzAgMTA2IDEzMCA5MEMxMzAgNzQgMTM0IDYwIDE1MCA2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8cGF0aCBkPSJNODAgMTYwQzgwIDE1MCA5MCAxNDAgMTA1IDE0MEgxOTVDMjEwIDE0MCAyMjAgMTUwIDIyMCAxNjBWMTkwSDgwVjE2MFoiIGZpbGw9IiM2MTc0NTciLz4KICA8dGV4dCB4PSIxNTAiIHk9IjIyMCIgdGV4dC1hbmNob3I9Im1pZGRsZSIgZmlsbD0iIzk5QTNBRiIgZm9udC1mYW1pbHk9IkFyaWFsLCBzYW5zLXNlcmlmIiBmb250LXNpemU9IjE0cHgiPk5vIEltYWdlPC90ZXh0Pgo8L3N2Zz4K'">

                        <!-- Hover Overlay -->
                        <div x-show="isHovered"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent flex items-end justify-center p-4">
                            <button @click="showInfo = !showInfo"
                                    class="bg-white/90 backdrop-blur-sm text-green-700 px-4 py-2 rounded-full font-semibold hover:bg-white transition duration-200 shadow-lg">
                                <span x-show="!showInfo">Learn More</span>
                                <span x-show="showInfo">Show Less</span>
                            </button>
                        </div>

                        <!-- Dog Breed Badge -->
                        <div class="absolute top-3 right-3 bg-green-600 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            {{ $dog->breed }}
                        </div>
                    </div>

                    <!-- Dog Information -->
                    <div class="p-6">
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h2 class="text-xl font-bold text-gray-800 mb-2 flex items-center">
                                {{ $dog->name }}
                                @if($dog->age < 1)
                                    <span class="ml-2 bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Puppy</span>
                                @elseif($dog->age > 7)
                                    <span class="ml-2 bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Senior</span>
                                @endif
                            </h2>

                            <!-- Quick Stats -->
                            <div class="grid grid-cols-2 gap-3 text-sm">
                                <div class="flex items-center text-gray-600">
                                    <x-heroicon-o-clock class="w-4 h-4 mr-2 text-green-600"/>
                                    <span>{{ $dog->age }} {{ $dog->age == 1 ? 'year' : 'years' }}</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <x-heroicon-o-scale class="w-4 h-4 mr-2 text-green-600"/>
                                    <span>{{ $dog->weight }} kg</span>
                                </div>
                                <div class="flex items-center text-gray-600">
                                    <x-heroicon-o-swatch class="w-4 h-4 mr-2 text-green-600"/>
                                    <span>{{ $dog->color }}</span>
                                </div>
                                @if($dog->owner)
                                    <div class="flex items-center text-gray-600">
                                        <x-heroicon-o-user class="w-4 h-4 mr-2 text-green-600"/>
                                        <span>{{ $dog->owner }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Additional Info Section -->
                        <div x-show="showInfo"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-40"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-40"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="border-t border-green-100 pt-4 overflow-hidden">
                            @if($dog->additional_info)
                                <div class="bg-green-50 rounded-lg p-4 border-l-4 border-green-400">
                                    <h4 class="text-sm font-semibold text-green-800 mb-2 flex items-center">
                                        <x-heroicon-o-information-circle class="w-4 h-4 mr-1"/>
                                        Additional Information
                                    </h4>
                                    <p class="text-sm text-green-700 leading-relaxed">{{ $dog->additional_info }}</p>
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <x-heroicon-o-document-text class="w-8 h-8 mx-auto text-gray-400 mb-2"/>
                                    <p class="text-sm text-gray-500">No additional information available</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Empty State -->
        @if($dogs->isEmpty())
            <div class="text-center py-16">
                <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-8">
                    <x-dk.logo class="w-20 h-20 mx-auto mb-4 text-gray-400"/>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">No Dogs Currently</h3>
                    <p class="text-gray-600 mb-6">Check back later to see our wonderful dogs!</p>
                </div>
            </div>
        @endif

        <!-- Pagination -->
        @if($dogs->hasPages())
            <div class="mt-12 flex justify-center">
                <div class="bg-white rounded-2xl shadow-lg p-4">
                    {{ $dogs->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
