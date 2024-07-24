<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Tasks')}}</h1>
    </x-slot>

    <a href="{{ route('tasks.create') }}">
        <x-primary-button >
            {{ __('Create task') }}
        </x-primary-button>
    </a>

    <table class="mt-4">
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
                                <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task)  }}">
                                    {{ __('Delete') }}
                                </a>
                            @endif
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task)  }}">
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