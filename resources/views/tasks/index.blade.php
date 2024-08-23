
@php
    $selectAttr = "class= rounded border-gray-300 dark:border-gray-700 dark:bg-black dark:text-neutral-200";
@endphp


<x-app-layout>
    <x-header>
        {{ __('Tasks')}}
    </x-header>

    <div class="flex flex-wrap w-full items-center justify-between">
        {{  html()->form('GET', route('tasks.index'))->class('flex flex-wrap gap-x-1 gap-y-5')->open() }}
                {{  html()->select('filter[status_id]', $statusesByIds, $filter['status_id'] ?? 0)->class($selectAttr)->placeholder(__('Status'))    }}
                {{  html()->select('filter[created_by_id]', $usersByIds, $filter['created_by_id'] ?? 0)->class($selectAttr)->placeholder(__('Author'))    }}
                {{  html()->select('filter[assigned_to_id]', $usersByIds, $filter['assigned_to_id'] ?? 0)->class($selectAttr)->placeholder(__('Executor'))    }}
                <x-primary-button>
                    {{ __('Accept') }}
                </x-primary-button>
        {{ html()->form()->close()}}
        
        @can('create', App\Models\Task::class)
        <div>
            <x-primary-link href="{{ route('tasks.create') }}">
                {{ __('Create task') }}
            </x-primary-link>
        </div>
        @endcan

    </div>

    <table class="mt-4 dark:text-neutral-200">
        <thead class="hidden md:table-header-group border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Author') }}</th>
                <th>{{ __('Executor') }}</th>
                <th>{{ __('Created at') }}</th>
                @auth
                    <th>{{ __('Actions')}} </th>
                @endauth
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="flex flex-wrap justify-between md:table-row flex-initial w-full md:border-b md:border-dashed text-left">
                    <td class="order-1 flex-none w-10">{{  $task->id }}</td>
                    <td class="order-3 c">{{  $task->status->name   }}</td>
                    <td class="order-2 basis-11/12 max-w-full" >
                        <a href="{{ route('tasks.show', $task->id)}}" class="text-blue-700 hover:text-indigo-400">
                            {{  $task->name }}
                        </a></td>
                    <td class="order-5 basis-full">{{  $task->author->name }}</td>
                    <td class="order-4 basis-full"> 
                        @if ($task->assignedTo?->name)
                        {{  __('Assigned to: ') . $task->assignedTo?->name }}
                        @endif
                    </td>
                    <td class="order-6 flex-auto w-64">{{  $task->created_at->format('d.m.Y')  }}</td>       
                    <td class="order-7">                 
                        @can('delete', $task)
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('tasks.destroy', $task->id)  }}">
                                {{ __('Delete') }}
                            </a>
                        @endcan
                        
                        @can('update', $task)
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('tasks.edit', $task->id)  }}">
                                {{ __('Change') }}
                            </a>
                        @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $tasks->links('pagination::tailwind') }}
    </div>

</x-app-layout>