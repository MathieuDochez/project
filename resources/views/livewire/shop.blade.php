<div>
    <!-- Filter Bar Component -->
    @livewire('components.filter-bar', ['config' => $filterConfig])

    <!-- Items Grid -->
    @if($items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8">
            @foreach($items as $item)
                <x-dk.item-card :item="$item"/>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $items->links() }}
        </div>
    @else
        <!-- No Results Found -->
        <div class="text-center py-12 bg-white rounded-lg shadow-md">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33l-.147-.15a6 6 0 018.13-8.13L14.46 5M15 13h.01"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No items found</h3>
            <p class="mt-1 text-sm text-gray-500">
                @if($search || $categoryFilter || $minPrice || $maxPrice)
                    Try adjusting your search criteria or filters.
                @else
                    No items are currently available.
                @endif
            </p>
        </div>
    @endif

    <!-- Loading Indicator -->
    <div wire:loading.flex class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <svg class="animate-spin h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Loading...</span>
        </div>
    </div>
</div>
