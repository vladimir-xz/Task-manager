@php
    $divAttributes = "class=mt-2";
    $inputStyle = 'w-1/3 rounded border-gray-300';
    $labelStyle = 'block font-medium text-sm text-gray-700 dark:text-gray-300';
@endphp


<div {{ $divAttributes }}>
    {{  html()->label(__('Name'), 'name')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->input('text', 'name')->class($inputStyle)   }}
</div>
<x-input-error :messages="$errors->get('name')" class="mt-2" />
<div {{ $divAttributes }}>
    {{  html()->label(__('Description'), 'description')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->textarea('description')->class($inputStyle)}}
</div>
<x-input-error :messages="$errors->get('description')" class="mt-2" />
<div {{ $divAttributes }}>
    {{  html()->label(__('Status'), 'status_id')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->select('status_id', $statusesByIds)->class($inputStyle)->placeholder('') }}
</div>
<x-input-error :messages="$errors->get('status_id')" class="mt-2" />
<div {{ $divAttributes }}>
    {{  html()->label(__('Assigned to'), 'assigned_to_id')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->select('assigned_to_id', $usersByIds)->class($inputStyle)->placeholder('')   }}
</div>
<x-input-error :messages="$errors->get('assigned_to_id')" class="mt-2" />
<div {{ $divAttributes }}>
    {{  html()->label(__('Labels'), 'labels')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->multiselect('labels', $labelsById)->class($inputStyle)}}
</div>
<x-input-error :messages="$errors->get('label_id')" class="mt-2" />
