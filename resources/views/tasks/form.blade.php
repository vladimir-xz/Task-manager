@if ($errors->any())
    <x-input-error :messages="$errors->all()" class="mt-2 list-disc" />
@endif


<div class="mt-2">
    {{  html()->label(__('Name'), 'name')->class('block font-medium text-sm text-gray-700 dark:text-gray-300') }}
</div>
<div class="mt-2">
    {{  html()->input('text', 'name')->class('w-1/3 rounded border-gray-300')}}
</div>
