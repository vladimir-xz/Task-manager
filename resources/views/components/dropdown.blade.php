@props(['align' => 'right', 'width' => '', 'contentClasses' => 'py-1 bg-white dark:text-white dark:bg-gray-900'])

@php
$alignmentClasses = match ($align) {
    'left' => 'ltr:origin-top-left rtl:origin-top-right start-0',
    'top' => 'origin-top',
    default => 'ltr:origin-top-right rtl:origin-top-left end-0',
};

$width = match ($width) {
    '48' => 'w-48',
    '11/12' => 'w-11/12',
    '96' => 'w-96',
    'full' => 'w-screen',
    default => $width,
};
@endphp

<div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open" class="md:hidden">
        {{ $trigger }}
    </div>

    <div x-show="open"
            :class="{'block': open, 'hidden': !open}"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            class="absolute md:static z-50 mt-2 md:mt-0  {{ $width }} rounded-md shadow-lg md:shadow-none {{ $alignmentClasses }}"
            style="display: none;"
            @click="open = false">
        <div class="rounded-md ring-1 ring-black ring-opacity-5 {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
