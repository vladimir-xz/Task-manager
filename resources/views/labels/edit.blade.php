<x-app-layout>
    <x-slot name="header">
        <h1 class="mb-5 text-5xl">{{ __('Edit label')}}</h1>
    </x-slot>

    {{  html()->modelForm($label, "PATCH", route('labels.update', $label))->class('flex flex-col')->open() }}
        @include('labels.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm()    }}
</x-app-layout>