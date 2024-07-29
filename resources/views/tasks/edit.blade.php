<x-app-layout>

    <x-header>
        {{ __('Edit task') }}
    </x-header>

    {{  html()->modelForm($task, 'PATCH', route('tasks.update', $task))->class('flex flex-col w-50')->open() }}
        @include('tasks.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm() }}
</x-app-layout>