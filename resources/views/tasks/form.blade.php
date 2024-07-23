@if ($errors->any())
    <x-input-error :messages="$errors->all()" class="mt-2 list-disc" />
@endif

@php
    $divAttributes = "class=mt-2";
    $inputStyle = 'w-1/3 rounded border-gray-300';
    $labelStyle = 'block font-medium text-sm text-gray-700 dark:text-gray-300';
@endphp


<div {{ $divAttributes }}>
    {{  html()->label(__('Name'), 'name')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->input('text', 'name')->class($inputStyle)}}
</div>
<div {{ $divAttributes }}>
    {{  html()->label(__('Description'), 'description')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->text('description')->class($inputStyle)}}
</div>
<div {{ $divAttributes }}>
    {{  html()->label(__('Status'), 'status_id')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->select('status_id', $statusesByIds)->class($inputStyle)}}
</div>
<div {{ $divAttributes }}>
    {{  html()->label(__('Assigned to'), 'assigned_to_id')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->select('assigned_to_id', $usersByIds)->class($inputStyle)}}
</div>
<!-- <div {{ $divAttributes }}>
    {{  html()->label(__('Marks'), 'name')->class($labelStyle) }}
</div>
<div {{ $divAttributes }}>
    {{  html()->input('text', 'name')->class($inputStyle)}}
</div> -->
