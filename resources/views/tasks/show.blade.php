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
                {{  html()->label(__('To') . ':', 'recipients')->class('font-medium') }}
                <div class="flex flex-wrap justify-between mt-2 items-end">
                    {{  html()->multiselect('recipients', $usersByIds)->class('rounded dark:text-black basis-5/6')->placeholder('')   }}
                    <div class="mt-2">
                        <x-primary-button >
                            {{ __('Create') }}
                        </x-primary-button>
                    </div>    
                </div>
            {{  html()->form()->close() }}
        </div>
    @endcan

    <div class="flex flex-wrap max-w-3xl">
        @foreach ($task->comments as $comment)

        @php 
            $usersMessage = Auth::user() == $comment->author ? 'order-first' : '';
        @endphp

        <div class="flex basis-full my-4">
            <div class="flex flex-1 flex-col basis-2/12 items-center justify-center text-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-12 w-12 dark:fill-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>

                <p >{{   $comment->author->name  }} </p>
                @can('delete', $comment)
                    <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.comments.destroy', [$task, $comment])  }}">
                        {{ __('Delete') }}
                    </a>
                @endcan
                
                @can('update', $comment)
                    <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.comments.edit', [$task, $comment])  }}">
                        {{ __('Change') }}
                    </a>
                @endcan
            </div>
            <div class="basis-5/6 {{  $usersMessage  }}">
                @if ($comment->recipients()->exists())
                    <div class="">
                            {{  __('For') . ': ' . $comment->recipients->map(fn ($user) => $user->name)->join(', ')  }}.
                    </div>
                @endif
                <div class="flex-1 basis-full p-4 max-h-full flex break-words bg-slate-200 rounded dark:text-black">
                    {{  $comment->content   }}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</x-app-layout>

