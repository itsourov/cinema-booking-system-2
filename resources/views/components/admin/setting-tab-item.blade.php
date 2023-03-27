@props(['active', 'target'])
<li>
    <button {{ $attributes }} class="w-full text-start bg-gray-100 dark:bg-gray-700 rounded-md p-3 "
        data-tabs-target="#{{ $target }}" type="button" role="tab" aria-controls="{{ $target }}"
        aria-selected="{{ $active ?? false ? 'true' : 'false' }}">
        {{ $slot }}
    </button>
</li>
