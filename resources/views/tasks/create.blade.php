<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Create status') }}</h1>
    </x-slot>

    {{  html()->form('POST', route('task_statuses.store'))->class('flex flex-col w-50')->open() }}
        @include('taskStatuses.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    {{  html()->form()->close() }}
</x-app-layout>