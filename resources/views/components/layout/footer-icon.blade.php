<a {{ $attributes->merge([
        'href' => '#!',
        'target' => '_tall',
        'class' => "text-cyan-600 hover:text-gray-500 hover:scale-150 transition duration-150"
    ]) }}>
    <x-icon class="size-4" name="{{ $icon ?? 'heroicon-s-question-mark-circle' }}"/>
</a>
