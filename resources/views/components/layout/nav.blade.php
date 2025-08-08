{{-- resources/views/components/layout/nav.blade.php --}}
<nav class="container mx-auto px-4 py-4">
    <div class="flex items-center justify-between">
        {{-- Left Navigation --}}
        <div class="flex items-center space-x-8">
            {{-- Logo & Brand --}}
            <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                <div class="transition-transform duration-200 group-hover:scale-105">
                    <x-dk.logo class="w-10 h-10"/>
                </div>
                <div class="hidden sm:block">
                    <h1 class="font-bold text-xl text-gray-800 group-hover:text-green-600 transition duration-200">
                        The Dog Kennel
                    </h1>
                    <p class="text-xs text-gray-500 -mt-0.5">Premium Dog Care</p>
                </div>
            </a>

            {{-- Navigation Links --}}
            <div class="hidden lg:flex items-center space-x-6">
                <x-nav-link href="{{ route('shop') }}"
                            :active="request()->routeIs('shop')"
                            class="nav-link">
                    Shop
                </x-nav-link>
                <x-nav-link href="{{ route('reviews') }}"
                            :active="request()->routeIs('reviews')"
                            class="nav-link">
                    Reviews
                </x-nav-link>
                <x-nav-link href="{{ route('dog-gallery') }}"
                            :active="request()->routeIs('dog-gallery')"
                            class="nav-link">
                    Our Dogs
                </x-nav-link>
                <x-nav-link href="{{ route('contact') }}"
                            :active="request()->routeIs('contact')"
                            class="nav-link">
                    Contact
                </x-nav-link>
            </div>
        </div>

        {{-- Right Navigation --}}
        <div class="flex items-center space-x-4">
            {{-- Guest Actions --}}
            @guest
                <div class="hidden sm:flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                       class="text-gray-600 hover:text-green-600 font-medium transition duration-200 {{ request()->routeIs('login') ? 'text-green-600' : '' }}">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                        Register
                    </a>
                </div>
            @endguest

            {{-- Mini Basket --}}
            @livewire('partials.mini-basket')

            {{-- User Dropdown --}}
            @auth
                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center space-x-2 px-3 py-2 rounded-lg hover:bg-gray-50 transition duration-200">
                            @livewire('partials.avatar')
                            <x-heroicon-o-chevron-down class="w-4 h-4 text-gray-500"/>
                        </button>
                    </x-slot>
                    <x-slot name="content">
                        {{-- User Info --}}
                        <div class="px-4 py-3 border-b border-gray-100">
                            @livewire('partials.name')
                        </div>

                        {{-- User Links --}}
                        <div class="py-2">
                            <x-dropdown-link href="{{ route('profile.show') }}" class="flex items-center">
                                <x-heroicon-o-user class="w-4 h-4 mr-3 text-gray-400"/>
                                Update Profile
                            </x-dropdown-link>
                            <x-dropdown-link href="{{ route('order-history') }}" class="flex items-center">
                                <x-heroicon-o-clipboard-document-list class="w-4 h-4 mr-3 text-gray-400"/>
                                Order History
                            </x-dropdown-link>
                        </div>

                        {{-- Admin Section --}}
                        @if(auth()->user()->admin)
                            <div class="border-t border-gray-100 py-2">
                                <div class="px-4 py-2">
                                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Admin</p>
                                </div>
                                <x-dropdown-link href="{{ route('admin.dashboard') }}" class="flex items-center">
                                    <x-heroicon-o-squares-2x2 class="w-4 h-4 mr-3 text-gray-400"/>
                                    Dashboard
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.dog') }}" class="flex items-center">
                                    <x-heroicon-o-heart class="w-4 h-4 mr-3 text-gray-400"/>
                                    Manage Dogs
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.orders') }}" class="flex items-center">
                                    <x-heroicon-o-shopping-cart class="w-4 h-4 mr-3 text-gray-400"/>
                                    Manage Orders
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.items') }}" class="flex items-center">
                                    <x-heroicon-o-cube class="w-4 h-4 mr-3 text-gray-400"/>
                                    Manage Items
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.reviewcrud') }}" class="flex items-center">
                                    <x-heroicon-o-star class="w-4 h-4 mr-3 text-gray-400"/>
                                    Manage Reviews
                                </x-dropdown-link>
                                <x-dropdown-link href="{{ route('admin.users') }}" class="flex items-center">
                                    <x-heroicon-o-users class="w-4 h-4 mr-3 text-gray-400"/>
                                    Manage Users
                                </x-dropdown-link>
                            </div>
                        @endif

                        {{-- Logout --}}
                        <div class="border-t border-gray-100 py-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="flex items-center w-full px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition duration-200">
                                    <x-heroicon-o-arrow-right-on-rectangle class="w-4 h-4 mr-3 text-gray-400"/>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            @endauth

            {{-- Mobile Menu Button --}}
            <button class="lg:hidden p-2 rounded-lg hover:bg-gray-100 transition duration-200"
                    onclick="toggleMobileMenu()">
                <x-heroicon-o-bars-3 class="w-6 h-6 text-gray-600"/>
            </button>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="lg:hidden hidden mt-4 pb-4 border-t border-gray-200 pt-4">
        <div class="space-y-2">
            <a href="{{ route('shop') }}"
               class="block px-4 py-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-200 {{ request()->routeIs('shop') ? 'text-green-600 bg-green-50' : '' }}">
                Shop
            </a>
            <a href="{{ route('reviews') }}"
               class="block px-4 py-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-200 {{ request()->routeIs('reviews') ? 'text-green-600 bg-green-50' : '' }}">
                Reviews
            </a>
            <a href="{{ route('dog-gallery') }}"
               class="block px-4 py-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-200 {{ request()->routeIs('dog-gallery') ? 'text-green-600 bg-green-50' : '' }}">
                Our Dogs
            </a>
            <a href="{{ route('contact') }}"
               class="block px-4 py-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-200 {{ request()->routeIs('contact') ? 'text-green-600 bg-green-50' : '' }}">
                Contact
            </a>

            @guest
                <div class="border-t border-gray-200 pt-4 mt-4 space-y-2">
                    <a href="{{ route('login') }}"
                       class="block px-4 py-2 text-gray-600 hover:text-green-600 hover:bg-green-50 rounded-lg transition duration-200">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                       class="block px-4 py-2 bg-green-600 text-white rounded-lg font-medium text-center">
                        Register
                    </a>
                </div>
            @endguest
        </div>
    </div>
</nav>

<style>
    /* Enhanced nav link styles */
    .nav-link {
        @apply relative px-3 py-2 text-gray-600 hover:text-green-600 font-medium transition-all duration-200 rounded-lg hover:bg-green-50;
    }

    /* Active state for nav links */
    .nav-link[aria-current="page"] {
        @apply text-green-600 bg-green-50;
    }

    /* Subtle hover effect */
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background-color: rgb(34 197 94);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link:hover::after,
    .nav-link[aria-current="page"]::after {
        width: 20px;
    }
</style>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
