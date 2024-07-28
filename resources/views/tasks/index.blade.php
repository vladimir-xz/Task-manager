<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Tasks')}}</h1>
    </x-slot>

    <div class="flex w-full items-center justify-between">
        {{  html()->form('GET', route('tasks.index'))->open() }}
                {{  html()->select('filter[status_id]', $statusesByIds, $filter['status_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Статус')    }}
                {{  html()->select('filter[created_by_id]', $usersByIds, $filter['created_by_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Автор')    }}
                {{  html()->select('filter[assigned_to_id]', $usersByIds, $filter['assigned_to_id'] ?? 0)->class('rounded border-gray-300')->placeholder('Исполнитель')    }}
                <x-primary-button>
                    {{ __('Accept') }}
                </x-primary-button>
        {{ html()->form()->close()}}
        
        @auth
        <div>
            <x-primary-link href="{{ route('tasks.create') }}">
                {{ __('Create task') }}
            </x-primary-link>
        </div>
        @endauth

    </div>

    <table class="mt-4 dark:text-neutral-200">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Executor') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Actions')}} </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $task->id }}</td>
                    <td>{{  $task->statusName   }}</td>
                    <td>
                        <a href="{{ route('tasks.show', $task->id)}}" class="text-blue-700 hover:text-indigo-400">
                            <x-short-inscription>
                                {{  $task->name }}
                            </x-short-inscription>
                        </a></td>
                    <td>{{  $task->author }}</td>
                    <td>{{  $task->assignedTo }}</td>
                    <td>{{  $task->createdAt }}</td>
                    <td>                        
                        @auth
                            @if (Auth::user()->name === $task->author)
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task->id)  }}">
                                    {{ __('Delete') }}
                                </a>
                            @endif
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task->id)  }}">
                                {{ __('Change') }}
                            </a>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links('pagination::tailwind') }}
    </div>

</x-app-layout>