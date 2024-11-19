<div>
    {{-- show preloader while fetching data in the background --}}

    {{-- filter section: artist or title, genre, max price and records per page --}}

    {{-- master section: cards with paginationlinks --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">

        <div
            class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
            <img class="w-52 h-52 border-r border-gray-300 object-cover"
                 src="{{ asset('storage/covers/no-cover.png') }}"
                 alt=""
                 title="">
            <div class="flex-1 flex flex-col">
                <div class="flex-1 p-4">
                    <p class="text-lg font-medium">Dog</p>
                    <p class="italic pb-2">Description</p>
                    <p class="italic font-thin text-right pt-2 mb-2">Breed</p>
                </div>
                <div class="flex justify-between border-t border-gray-300 bg-gray-100 px-4 py-2">
                    <div></div>
                    <div class="flex space-x-4">
                        <button class="w-6 hover:text-red-900">
                            <x-phosphor-shopping-bag-light/>
                        </button>
                        <button class="w-6 hover:text-red-900">
                            <x-phosphor-music-notes-light/>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Detail section --}}
</div>
