<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-4xl">{{ __('View task')}}: 
            <x-short-inscription>
                {{ $task->name }}
            </x-short-inscription>
        </h1>
        <div class=""></div>
    </x-slot>

    <ul>
        <li>
            <span class="font-medium">{{ __('Name')}}: </span>
            {{ $task->name }}
        </li>
        <li>
            <span class="font-medium">{{ __('Status')}}: </span>
            {{$task->status->name}}
        </li>
        <li>
            <span class="font-medium">{{ __('Description')}}: </span>
            {{$task->description}}
        </li>
        <li>
            <span class="font-medium">{{ __('Marsk')}}: </span>
        </li>
        <li>
            @if ($task->labels)
                @foreach ($task->labels as $label)
                    <x-label>
                        {{ $label->name }}
                    </x-label>
                @endforeach
            @endif
        </li>
    </ul>
</x-app-layout>