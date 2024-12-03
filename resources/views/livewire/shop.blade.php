<div>
    {{-- show preloader while fetching data in the background --}}

    {{-- filter section: artist or title, genre, max price and records per page --}}

    {{-- master section: cards with paginationlinks --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">
        @foreach($items as $item)
            @if($item !== null)
                <x-dk.item-card :item="$item"/>
            @else
                <h3>No Items to show</h3>
            @endif
        @endforeach
    </div>

    {{-- Detail section --}}
</div>
