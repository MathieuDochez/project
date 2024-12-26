<a href="{{ route('basket') }}" class="relative mr-3">
    <x-fas-shopping-basket class="w-4 h-4"/>
    @if($totalQty > 0)
        <span
            class="absolute -top-2 -right-2 text-xs bg-rose-500 text-rose-100 rounded-full w-4 h-4 flex items-center justify-center">
            {{ $totalQty }}
        </span>
    @endif
</a>
