<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Change status')}}</h1>
    </x-slot>

    {{  html()->modelForm($taskStatus, "PATCH", route('task_statuses.update', $taskStatus))->class('flex flex-col')->open() }}
        @include('taskStatuses.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm()    }}
</x-app-layout>