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

    @auth
        <li class="md:hidden border-t pt-3 dark:border-gray-500">
            <x-nav-link data-method="post" href="{{ route('logout')  }}">
                {{ __('Logout') }}
            </x-nav-link>
        </li>
    @endauth
    @guest
        <li class="md:hidden border-t pt-3 dark:border-gray-500">
            <x-nav-link href="{{ route('login') }}">
            {{ __('Login') }}
            </x-nav-link>
        </li>
        <li class="md:hidden">
            <x-nav-link href="{{ route('register') }}">
            {{ __('Sign up') }}
            </x-nav-link>
        </li>
    @endguest
</ul>

