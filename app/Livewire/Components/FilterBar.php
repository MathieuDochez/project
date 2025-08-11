<?php

namespace App\Livewire\Components;

use Livewire\Component;

class FilterBar extends Component
{
    // Filter values - these will be set from parent
    public $search = '';
    public $primaryFilter = '';
    public $minValue = '';
    public $maxValue = '';
    public $sortBy = '';
    public $sortDirection = 'asc';

    // Configuration properties
    public $searchPlaceholder = 'Search...';
    public $showSearch = true;
    public $showPrimaryFilter = false;
    public $showMinMaxFilter = false;
    public $showSortBy = false;
    public $showSortDirection = false;

    public $primaryFilterLabel = 'Filter';
    public $primaryFilterOptions = [];
    public $minValueLabel = 'Min Value';
    public $maxValueLabel = 'Max Value';
    public $sortByLabel = 'Sort By';
    public $sortByOptions = [];

    // Results info
    public $totalResults = 0;
    public $currentPage = 1;
    public $perPage = 10;
    public $showResultsInfo = true;

    protected $listeners = ['updateFilterResults' => 'updateResults'];

    public function mount($config = [])
    {
        // Set configuration
        $this->searchPlaceholder = $config['searchPlaceholder'] ?? 'Search...';
        $this->showSearch = $config['showSearch'] ?? true;
        $this->showPrimaryFilter = $config['showPrimaryFilter'] ?? false;
        $this->showMinMaxFilter = $config['showMinMaxFilter'] ?? false;
        $this->showSortBy = $config['showSortBy'] ?? false;
        $this->showSortDirection = $config['showSortDirection'] ?? false;

        $this->primaryFilterLabel = $config['primaryFilterLabel'] ?? 'Filter';
        $this->primaryFilterOptions = $config['primaryFilterOptions'] ?? [];
        $this->minValueLabel = $config['minValueLabel'] ?? 'Min Value';
        $this->maxValueLabel = $config['maxValueLabel'] ?? 'Max Value';
        $this->sortByLabel = $config['sortByLabel'] ?? 'Sort By';
        $this->sortByOptions = $config['sortByOptions'] ?? [];

        // Set initial values
        $this->search = $config['search'] ?? '';
        $this->primaryFilter = $config['primaryFilter'] ?? '';
        $this->minValue = $config['minValue'] ?? '';
        $this->maxValue = $config['maxValue'] ?? '';
        $this->sortBy = $config['sortBy'] ?? '';
        $this->sortDirection = $config['sortDirection'] ?? 'asc';
    }

    public function updatedSearch()
    {
        $this->emitFilterChange();
    }

    public function updatedPrimaryFilter()
    {
        $this->emitFilterChange();
    }

    public function updatedMinValue()
    {
        $this->emitFilterChange();
    }

    public function updatedMaxValue()
    {
        $this->emitFilterChange();
    }

    public function updatedSortBy()
    {
        $this->emitFilterChange();
    }

    public function toggleSortDirection()
    {
        $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        $this->emitFilterChange();
    }

    public function clearFilters()
    {
        $this->search = '';
        $this->primaryFilter = '';
        $this->minValue = '';
        $this->maxValue = '';
        $this->sortBy = '';
        $this->sortDirection = 'asc';
        $this->emitFilterChange();
    }

    public function updateResults($data)
    {
        $this->totalResults = $data['total'] ?? 0;
        $this->currentPage = $data['currentPage'] ?? 1;
        $this->perPage = $data['perPage'] ?? 10;
    }

    protected function emitFilterChange()
    {
        $this->dispatch('filtersChanged', [
            'search' => $this->search,
            'primaryFilter' => $this->primaryFilter,
            'minValue' => $this->minValue,
            'maxValue' => $this->maxValue,
            'sortBy' => $this->sortBy,
            'sortDirection' => $this->sortDirection,
        ]);
    }

    public function getActiveFiltersCountProperty()
    {
        return collect([
            $this->search,
            $this->primaryFilter,
            $this->minValue,
            $this->maxValue
        ])->filter()->count();
    }

    public function getHasCustomSortingProperty()
    {
        return !empty($this->sortBy) || $this->sortDirection !== 'asc';
    }

    public function getFirstResultProperty()
    {
        return $this->totalResults > 0 ? (($this->currentPage - 1) * $this->perPage) + 1 : 0;
    }

    public function getLastResultProperty()
    {
        return min($this->currentPage * $this->perPage, $this->totalResults);
    }

    public function render()
    {
        return view('livewire.components.filter-bar');
    }
}
