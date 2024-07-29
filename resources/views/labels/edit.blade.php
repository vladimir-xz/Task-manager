<x-app-layout>
    <x-header>
        {{ __('Edit label')}}
    </x-header>

    {{  html()->modelForm($label, "PATCH", route('labels.update', $label))->class('flex flex-col')->open() }}
        @include('labels.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Edit') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm()    }}
</x-app-layout>