@props(['lang'])

@php
$locale = App::getLocale();

$language = match ($locale) {
    'eng' => __('English'),
    'ru' => __('Russian'),
    default => __('English'),
}
@endphp

<button {{ $attributes->merge([
        'id' => 'dropdownHoverButton',
        'data-dropdown-toggle' => 'dropdownHover',
        'data-dropdown-trigger' => 'hover',
        'class' => 'dark:text-white hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-blue-700 dark:focus:ring-blue-800',
        'type' => 'button'
    ]) }}
    >

    {{ $language }} 

    <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
    </svg>
</button>