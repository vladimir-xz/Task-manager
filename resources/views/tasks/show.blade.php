<x-app-layout>

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

    @can('create', $comment)
        <div class="mt-8 max-w-3xl">
            {{  html()->modelForm($comment, 'POST', route('tasks.comments.store', $task))->class('flex flex-col w-50')->open() }}
                {{  html()->label(__('Comment') . ':', 'content')->class('font-medium') }}
                {{  html()->textarea('content')->class('rounded min-h-8') }}
                <div class="mt-2">
                    <x-primary-button>
                        {{ __('Create') }}
                    </x-primary-button>
                </div>
            {{  html()->form()->close() }}
        </div>
    @endcan

    <div class="flex flex-wrap max-w-3xl">
        @foreach ($task->comments as $comment)
            <div class="flex-1 basis-full p-4 my-4 bg-slate-200 rounded">
                {{  $comment->content   }}
            </div>
        @endforeach
    </div>
</x-app-layout>

