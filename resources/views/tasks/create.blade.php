<x-app-layout>
    <x-header>
        {{ __('Create task') }}
    </x-header>

    {{  html()->form('POST', route('tasks.store'))->class('flex flex-col w-50')->open() }}
        @include('tasks.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    {{  html()->form()->close() }}
</x-app-layout>