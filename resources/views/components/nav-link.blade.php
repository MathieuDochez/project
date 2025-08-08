@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'relative px-3 py-2 text-green-600 bg-green-50 font-medium transition-all duration-200 rounded-lg'
                : 'relative px-3 py-2 text-gray-600 hover:text-green-600 font-medium transition-all duration-200 rounded-lg hover:bg-green-50';

    $ariaCurrentValue = ($active ?? false) ? 'page' : null;
@endphp

<a {{ $attributes->merge(['class' => $classes, 'aria-current' => $ariaCurrentValue]) }}>
    {{ $slot }}
</a>
