<x-app-layout>
    <x-header>
        {{ __('Create label') }}
    </x-header>

    {{  html()->modelForm($label, 'POST', route('labels.store'))->class('flex flex-col w-50')->open() }}
        @include('labels.form')
        <div class="mt-2">
            <x-primary-button>
                {{ __('Create') }}
            </x-primary-button>
        </div>
    {{  html()->closeModelForm() }}
</x-app-layout>