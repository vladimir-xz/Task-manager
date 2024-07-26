<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Statuses')}}</h1>
    </x-slot>

    @auth
    <x-primary-link href="{{ route('task_statuses.create') }}">
        {{ __('Create status') }}
    </x-primary-link>
    @endauth

    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Created at') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($taskStatuses as $taskStatus)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $taskStatus->id }}</td>
                    <td>{{  $taskStatus->name   }}</td>
                    <td>{{  $taskStatus->created_at->format('d.m.Y') }}</td>
                    <td>
                        @auth
                            <a data-confirm="Вы уверены?" data-method="delete" class="text-red-600 hover:text-red-900" href="{{ route('task_statuses.destroy', $taskStatus)  }}">
                                {{ __('Delete') }}
                            </a>
                            <a class="text-blue-600 hover:text-blue-900" href="{{ route('task_statuses.edit', $taskStatus)  }}">
                                {{ __('Change') }}
                            </a>
                        @endauth
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-3">
        {{ $taskStatuses->links('pagination::tailwind') }}
    </div>
</x-app-layout>