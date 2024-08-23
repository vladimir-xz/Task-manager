@props(['role' => 'mainMenu'])

@php
    $menuUi = match ($role) {
        'mainMenu' => 'flex flex-col space-y-4 text-center md:space-y-0 justify-stretch md:flex-row md:space-x-4 ms-4 font-medium',
        'dropdown' => 'block w-full px-4 py-3 text-center text-sm leading-5 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-800 transition duration-150 ease-in-out',
        default => 'flex flex-col space-y-4 text-center md:space-y-0 justify-stretch md:flex-row md:space-x-4 ms-4 font-medium'
    };
@endphp

<ul {{ $attributes->merge(['class' => 'flex flex-col justify-stretch md:flex-row md:space-x-4 ms-4 font-medium'])   }}>
    <li>
        <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index') " class="{{ $menuUi  }}">
            {{ __('Tasks') }}
        </x-nav-link>
    </li>
    <li>
        <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')" class="{{ $menuUi  }}">
            {{ __('Statuses') }}
        </x-nav-link>
    </li>
    <li>
        <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')" class="{{ $menuUi  }}">
            {{ __('Labels') }}
        </x-nav-link>
    </li>

    @auth
        <li class="md:hidden border-t pt-3 dark:border-gray-500">
            <x-nav-link data-method="post" href="{{ route('logout')  }}" class="{{ $menuUi  }}">
                {{ __('Logout') }}
            </x-nav-link>
        </li>
    @endauth
    @guest
        <li class="md:hidden border-t pt-3 dark:border-gray-500">
            <x-nav-link href="{{ route('login') }}" class="{{ $menuUi  }}">
            {{ __('Login') }}
            </x-nav-link>
        </li>
        <li class="md:hidden">
            <x-nav-link href="{{ route('register') }}" class="{{ $menuUi  }}">
            {{ __('Sign up') }}
            </x-nav-link>
        </li>
    @endguest
</ul>

