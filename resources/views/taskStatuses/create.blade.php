<x-app-layout>
    <x-header>
        {{ __('Create status') }}
    </x-header>

    {{  html()->form('POST', route('task_statuses.store'))->class('flex flex-col w-50')->open() }}
        @include('taskStatuses.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    {{  html()->form()->close() }}
</x-app-layout>