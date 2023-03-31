<button
    {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
