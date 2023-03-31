@props(['value'])

<label {{ $attributes->merge(['class' => 'text-sm font-medium ']) }}>
    {{ $value ?? $slot }}
</label>
