@php
    $color = match ((string) $slot) {
        'New' => 'text-red-600',
        'Underway' => 'text-orange-200',
        'Testing' => 'text-lime-600',
        'Completed' => 'text-gray-300 dark:text-gray-500',
        default => 'text-white',
    }
@endphp
<span {{ $attributes->merge(['class' => $color]) }}>
    {{  __((string) $slot)  }}
</span>