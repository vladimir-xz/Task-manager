<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Tasks')}}</h1>
    </x-slot>

    <a href="{{ route('task_statuses.create') }}">
        <x-primary-button >
            {{ __('Create task') }}
        </x-primary-button>
    </a>

    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
            <tr>
                <th>ID</th>
                <th>Статус</th>
                <th>Имя</th>
                <th>Автор</th>
                <th>Исполнитель</th>
                <th>Дата создания</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
                <tr class="border-b border-dashed text-left">
                    <td>{{  $task->id }}</td>
                    <td>{{  $task->status->name   }}</td>
                    <td>{{  $task->name }}</td>
                    <td>{{  $task->creator->name }}</td>
                    <td>{{  $task->assignedTo?->name }}</td>
                    <td>{{  $task->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</x-app-layout>