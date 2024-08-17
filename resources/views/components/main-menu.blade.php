<ul {{ $attributes->merge(['class' => 'flex flex-col space-y-4 md:space-y-0 justify-stretch md:flex-row md:space-x-4 ms-4 font-medium'])   }}>
    <li>
        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index') " class="text-center">
            {{ __('Tasks') }}
        </x-nav-link>
    </li>
    <li>
        <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')" class="text-center">
            {{ __('Statuses') }}
        </x-nav-link>
    </li>
    <li>
        <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')" class="text-center">
            {{ __('Labels') }}
        </x-nav-link>
    </li>
</ul>