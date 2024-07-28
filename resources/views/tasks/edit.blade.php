<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Edit task') }}</h1>
    </x-slot>

    {{  html()->modelForm($task, 'PATCH', route('tasks.update', $task))->class('flex flex-col w-50')->open() }}
        @include('tasks.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm() }}
</x-app-layout>