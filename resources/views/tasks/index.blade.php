@php
    $selectAttr = "flex-1 rounded border-gray-300 dark:border-gray-700 dark:bg-black dark:text-neutral-200";
@endphp


<x-app-layout>
    <x-header>
        {{ __('Tasks')}}
    </x-header>

    <div class="sm:flex flex-wrap w-full items-center justify-between">
        {{  html()->form('GET', route('tasks.index'))->class('flex flex-wrap md:flex-row gap-x-1 gap-y-5')->open() }}
                {{  html()->select('filter[status_id]', $statusesByIds, $filter['status_id'] ?? 0)->class($selectAttr)->placeholder(__('Status'))    }}
                {{  html()->select('filter[created_by_id]', $usersByIds, $filter['created_by_id'] ?? 0)->class($selectAttr)->placeholder(__('Author'))    }}
                {{  html()->select('filter[assigned_to_id]', $usersByIds, $filter['assigned_to_id'] ?? 0)->class($selectAttr)->placeholder(__('Executor'))    }}
                <div class="hidden flex flex-1 basis-1/12 shrink gap-x-2 w-100">  
                    {{  html()->input('filter[assigned_to_id]', $filter['fromDate'] ?? 0)->class($selectAttr . 'basis-1/12 py-2 px-3')->placeholder(__('From'))    }}
                    
                    {{  html()->input('filter[assigned_to_id]', $filter['tillDate'] ?? 0)->class($selectAttr . 'basis-1/12 px-3')->placeholder(__('Until'))    }}
                </div>
                {{  html()->input('filter[assigned_to_id]', $filter['description'] ?? 0)->class($selectAttr . 'shrink py-2 px-3')->placeholder(__('Search'))    }}
                <x-primary-button class="justify-center ms-4 lg:ms-0">
                    {{ __('Accept') }}
                </x-primary-button>
        {{ html()->form()->close()}}
        
        @can('create', App\Models\Task::class)
        <div class="my-8">
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
        <tbody class="max-md:divide-y max-md:divide-slate-700">
            @foreach ($tasks as $task)
                <tr class="flex flex-wrap justify-between mb-2 md:mb-0 md:table-row flex-initial w-full md:border-b md:border-dashed text-left">
                    <td class="order-1 flex-none py-1">{{  $task->id }}</td>
                    <td class="order-3 basis-full"><x-status-name>{{ $task->status->name  }}</x-status-name></td>
                    <td class="order-2 grow basis-11/12" >
                        <a href="{{ route('tasks.show', $task->id)}}" class="text-xl md:text-base text-blue-700 hover:text-indigo-400 ">
                            {{  $task->name }}
                        </a>

                        @if ($task->labels()->exists())
                            @foreach ($task->labels as $label)
                                <x-label :withIcon='false'>
                                    {{ $label->name }}
                                </x-label>
                            @endforeach
                        @endif

                        @if ($task->notifications()->exists())
                            @php $newMessage = $task->notifications->first(fn ($notif) => $notif->label->name === 'new response' && $notif->recipient == Auth::user())
                            @endphp
                            @if ($newMessage)
                            <x-label :withIcon='false'>
                                {{ $newMessage->label->name }}
                            </x-label>
                            @endif
                        @endif
                    </td>
                    <td class="order-5 basis-full">{{  $task->author->name }}</td>
                    <td class="order-4 basis-full"> 
                        @if ($task->assignedTo?->name)
                            <span class="md:hidden text-orange-700">{{  __('Assigned to') }}: </span>{{ $task->assignedTo?->name }}
                        @endif
                    </td>
                    <td class="order-6 flex-auto">{{  $task->created_at->format('d.m.Y')  }}</td>       
                    <td class="order-7 ">                 
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