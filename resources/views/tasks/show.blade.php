<x-app-layout>

{{  var_dump($decryptedData)  }}
    <x-header>
        <x-short-inscription>
            {{ $task->name }}
        </x-short-inscription>
        <a href="{{  route('tasks.edit', $task) }}">⚙</a>
    </x-header>

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

