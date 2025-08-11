<div class="bg-white rounded-lg shadow-md p-6 mb-8 relative">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">Search & Filter</h2>

    <!-- Search Bar -->
    @if($showSearch)
        <div class="mb-4">
            <div class="relative">
                <input
                    type="text"
                    wire:model.live.debounce.300ms="search"
                    placeholder="{{ $searchPlaceholder }}"
                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                >
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    @endif

    <!-- Filters Row -->
    @if($showPrimaryFilter || $showMinMaxFilter || $showSortBy)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">

            <!-- Primary Filter -->
            @if($showPrimaryFilter && !empty($primaryFilterOptions))
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $primaryFilterLabel }}</label>
                    <select wire:model.live="primaryFilter" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">All {{ $primaryFilterLabel }}</option>
                        @foreach($primaryFilterOptions as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            <!-- Min/Max Value Filter -->
            @if($showMinMaxFilter)
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $minValueLabel }}</label>
                    <input
                        type="number"
                        wire:model.live.debounce.500ms="minValue"
                        placeholder="0.00"
                        step="0.01"
                        min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $maxValueLabel }}</label>
                    <input
                        type="number"
                        wire:model.live.debounce.500ms="maxValue"
                        placeholder="999.99"
                        step="0.01"
                        min="0"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    >
                </div>
            @endif

            <!-- Sort By -->
            @if($showSortBy && !empty($sortByOptions))
                <div class="{{ $showMinMaxFilter ? 'md:col-span-2 lg:col-span-1' : '' }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">{{ $sortByLabel }}</label>
                    <select wire:model.live="sortBy" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach($sortByOptions as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    @endif

    <!-- Sort Direction and Clear Filters -->
    <div class="flex flex-wrap items-center justify-between gap-4">
        <div class="flex items-center space-x-4">
            <!-- Sort Direction Toggle -->
            @if($showSortDirection && $sortBy)
                <button
                    wire:click="toggleSortDirection"
                    class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:ring-2 focus:ring-blue-500"
                >
                    @if($sortDirection === 'asc')
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                        </svg>
                        Ascending
                    @else
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                        Descending
                    @endif
                </button>
            @endif

            <!-- Active Filters Count -->
            @if($this->activeFiltersCount > 0)
                <span class="text-sm text-gray-600">
                    {{ $this->activeFiltersCount }} filter{{ $this->activeFiltersCount !== 1 ? 's' : '' }} active
                </span>
            @endif

            <!-- Custom Sorting Indicator -->
            @if($this->hasCustomSorting)
                <span class="text-sm text-gray-600">
                    @if($this->activeFiltersCount > 0), @endif
                    Custom sorting applied
                </span>
            @endif
        </div>

        <!-- Clear Filters Button -->
        @if($this->activeFiltersCount > 0 || $this->hasCustomSorting)
            <button
                wire:click="clearFilters"
                class="inline-flex items-center px-4 py-2 border border-red-300 rounded-lg text-sm font-medium text-red-700 bg-red-50 hover:bg-red-100 focus:ring-2 focus:ring-red-500"
            >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
                Clear All Filters
            </button>
        @endif
    </div>

    <!-- Results Summary -->
    @if($showResultsInfo && $totalResults > 0)
        <div class="mt-4 pt-4 border-t border-gray-200">
            <div class="flex justify-between items-center text-sm text-gray-600">
                <div>
                    Showing {{ $this->firstResult }} to {{ $this->lastResult }} of {{ $totalResults }} results
                </div>
                <div>
                    @if($search)
                        Search results for: <strong>"{{ $search }}"</strong>
                    @endif
                    @if($primaryFilter && isset($primaryFilterOptions[$primaryFilter]))
                        {{ $search ? ' | ' : '' }}{{ $primaryFilterLabel }}: <strong>{{ $primaryFilterOptions[$primaryFilter] }}</strong>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Loading Indicator -->
    <div wire:loading.flex class="absolute inset-0 bg-white bg-opacity-75 rounded-lg items-center justify-center">
        <div class="flex items-center space-x-2">
            <svg class="animate-spin h-5 w-5 text-blue-500" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span class="text-gray-700">Filtering...</span>
        </div>
    </div>
</div>
