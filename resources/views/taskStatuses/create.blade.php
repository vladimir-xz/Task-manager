<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Create status') }}</h1>
    </x-slot>

    <div class="w-50">
        {{  html()->form('POST', route('task_statuses.store'))->class('w-50')->open() }}
        <div class="flex flex-col">
            @include('taskStatuses.form')
            <div class="mt-2">
                <x-primary-button>
                    {{ __('Create') }}
                </x-primary-button>
            </div>
        </div>
        {{  html()->form()->close() }}
    </div>
</x-app-layout>