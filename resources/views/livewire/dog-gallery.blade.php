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
                        <img src="{{ $dog->image_url }}"
                             alt="{{ $dog->name }}"
                             class="w-full h-full object-cover object-center transition-transform duration-500"
                             :class="isHovered ? 'scale-110' : 'scale-100'">

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

                        <!-- Image Status Badge -->
                        @if(!$dog->hasImage())
                            <div class="absolute top-3 left-3 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow-lg">
                                No Photo
                            </div>
                        @endif
                    </div>

                    <!-- Dog Information -->
                    <div class="p-6">
                        <!-- Basic Info -->
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $dog->name }}</h3>
                            <div class="grid grid-cols-2 gap-2 text-sm text-gray-600">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $dog->age }} years
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $dog->weight }} kg
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $dog->color }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ $dog->owner ?: 'Available' }}
                                </div>
                            </div>
                        </div>

                        <!-- Extended Info -->
                        <div x-show="showInfo"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform scale-95"
                             x-transition:enter-end="opacity-100 transform scale-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 transform scale-100"
                             x-transition:leave-end="opacity-0 transform scale-95"
                             class="mt-4 pt-4 border-t border-gray-200">
                            @if($dog->additional_info)
                                <p class="text-sm text-gray-600 mb-4">{{ $dog->additional_info }}</p>
                            @endif
                        </div>

                        <!-- Action Button -->
                        <div class="mt-4">
                            <button @click="showInfo = !showInfo"
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                                <span x-show="!showInfo">💚 Interested in {{ $dog->name }}?</span>
                                <span x-show="showInfo">Show Less Info</span>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $dogs->links() }}
        </div>
    </div>
</div>
