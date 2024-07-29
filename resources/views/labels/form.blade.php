@php
    $divAttributes = "class=mt-2";
@endphp

<div $divAttributes>
    {{  html()->label(__('Name'), 'name')->class('block font-medium text-sm text-gray-700 dark:text-gray-300') }}
</div>
<div $divAttributes>
    {{  html()->input('text', 'name')->class('w-1/3 rounded border-gray-300')}}
</div>
<x-input-error :messages="$errors->get('name')" class="mt-2" />
<div $divAttributes>
    {{  html()->label(__('Description'), 'description')->class('block font-medium text-sm text-gray-700 dark:text-gray-300') }}
</div>
<div $divAttributes>
    {{  html()->textarea('description')->class('w-1/3 rounded border-gray-300')}}
</div>
<x-input-error :messages="$errors->get('description')" class="mt-2" />

