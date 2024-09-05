@props(['withIcon' => true,])

@php
    $color = match ((string) $slot) {
        'normal' => 'bg-blue-200 text-blue-400 dark:text-blue-700',
        'high' => 'bg-red-400 text-black',
        'critical' => 'bg-red-700 text-black',
        'error' => 'bg-red-300 text-red-700',
        'docs' => 'bg-gray-300 text-gray-700',
        'new response' => 'bg-orange-300 text-orange-700',
        default => 'bg-blue-200 text-blue-400',
    };

    $size = $withIcon ? ' px-3 py-1 ' : ' px-2 py-1 '
@endphp

<div {{ $attributes->merge(['class' =>  $color . $size . "text-xs inline-flex items-center font-bold leading-sm uppercase rounded-full"]) }}>

    @if ($withIcon)
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
        </svg>
    @endif

    {{ __((string) $slot) }}
</div>