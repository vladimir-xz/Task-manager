<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">Изменение статуса</h1>
    </x-slot>

    <div>
        {{  html()->modelForm($taskStatus, "PATCH", route('task_statuses.update', $taskStatus))->open() }}
        <div class="flex flex-col">
            @include('taskStatuses.form')
            <div class="mt-2">
                <x-primary-button>
                    {{ __('Edit') }}
                </x-primary-button>
            </div>
        </div>
        {{  html()->closeModelForm()    }}
    </div>
</x-app-layout>