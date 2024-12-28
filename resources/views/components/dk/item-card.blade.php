<div x-data="{ inStock: {{ $item->stock }}, showDetails: true }" class="flex bg-white border border-gray-300 shadow-md rounded-lg overflow-hidden">
    <img class="w-52 h-52 border-r border-gray-300 object-cover"
         src="{{ asset('storage/img/' . $item->name . '.jpg') }}"
         alt="{{ $item->name }}"
         title="{{ $item->name }}">
    <div class="flex-1 flex flex-col">
        <div class="flex-1 p-4">
            <p class="text-lg font-medium">{{ $item->name }}</p>
            <p class="italic pb-2">{{ $item->description }}</p>
            <p class="italic font-thin text-right pt-2 mb-2">{{ $item->category }}</p>
            <p class="text-lg text-right">€{{ number_format($item->price, 2) }}</p>
        </div>
        <div class="flex justify-between border-t border-gray-300 bg-gray-100 px-4 py-2" x-show="showDetails">
            <div x-text="inStock > 0 ? inStock + ' items left in stock' : 'Out of stock'" class="text-sm"></div>
            <div class="flex space-x-4">
                <button wire:click="addToBasket({{ $item->id }})" x-bind:class="{ 'opacity-50': inStock <= 0 }" :disabled="inStock <= 0" class="w-6 hover:text-red-900">
                    <x-phosphor-shopping-bag-light/>
                </button>
            </div>
        </div>
    </div>
</div>
