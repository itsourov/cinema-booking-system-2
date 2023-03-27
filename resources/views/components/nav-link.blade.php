@props(['active'])

@php
    if ($active ?? false) {
        $classes = 'block py-2 pl-3 pr-4 text-white bg-blue-700 rounded  md:text-white  dark:text-white transition duration-150 ease-in-out';
    } else {
        $classes = 'block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100  md:border-0 md:hover:text-blue-700  dark:text-gray-400 md:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white ';
    }
    
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
