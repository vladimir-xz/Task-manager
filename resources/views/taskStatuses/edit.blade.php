<x-app-layout>
    <x-header>
        {{ __('Change status')}}
    </x-header>

    {{  html()->modelForm($taskStatus, "PATCH", route('task_statuses.update', $taskStatus))->class('flex flex-col')->open() }}
        @include('taskStatuses.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm()    }}
</x-app-layout>