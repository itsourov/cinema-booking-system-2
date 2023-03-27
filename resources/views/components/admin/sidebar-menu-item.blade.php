@props(['active', 'dropdown', 'id'])

@php
    if ($active ?? false) {
        $classes = 'bg-gray-100 dark:bg-gray-700';
    } else {
        $classes = '';
    }
    $classes = $classes . ' w-full flex items-center p-2 text-base text-gray-600 rounded-lg hover:bg-gray-100 group dark:text-gray-300 dark:hover:bg-gray-700';
    if (!isset($id)) {
        $id = rand();
    }
@endphp

@if ($dropdown ?? false)
    <li>
        <button type="button" {{ $attributes->merge(['class' => $classes]) }} aria-controls="{{ $id }}"
            data-collapse-toggle="{{ $id }}">
            {{ $icon }}
            <span class="flex-1 ml-3 text-left whitespace-nowrap" sidebar-toggle-item>{{ $title }}</span>
            <x-ri-arrow-down-s-line />
        </button>
        <ul id="{{ $id }}" class="{{ $active ? 'block' : 'hidden' }} py-2 space-y-2">
            {{ $submenu }}
        </ul>
    </li>
@else
    <li>
        <a {{ $attributes->merge(['class' => $classes]) }}>

            {{ $icon }}
            <span class="ml-3" sidebar-toggle-item>{{ $title }}</span>
        </a>
    </li>
@endif
