<div>
    <div class="grid grid-cols-1 lg:grid-cols-2 2xl:grid-cols-3 gap-8 mt-8">
        @foreach($items as $item)
            @if($item !== null)
                <x-dk.item-card :item="$item"/>
            @else
                <h3>No Items to show</h3>
            @endif
        @endforeach
    </div>
</div>
