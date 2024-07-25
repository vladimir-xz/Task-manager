<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-700 py-2.5">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a class="flex items-center" href="{{ route('main') }}">
                    <x-application-logo class="text-xl text-gray-800 dark:text-gray-200" />
                </a>

                <!-- Navigation Links -->
                <div class="items-center justify-between w-full lg:flex lg:w-auto lg:order-1 hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li>
                            <x-nav-link :href="route('tasks.index')" :active="request()->routeIs('tasks.index')">
                                {{ __('Tasks') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('task_statuses.index')" :active="request()->routeIs('task_statuses.index')">
                                {{ __('Statuses') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('labels.index')" :active="request()->routeIs('labels.index')">
                                {{ __('Labels') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </div>
                <div class="flex items-center lg:order-2">
                @auth
                   {{ html()->form('POST', route('logout'))->open() }}

                        <x-primary-button class="ms-4">
                            {{ __('Logout') }}
                        </x-primary-button>

                    {{ html()->form()->close() }}
                @endauth
                
                @guest
                <a href="{{ route('login') }}">
                    <x-primary-button class="ms-4">
                        {{ __('Login') }}
                    </x-primary-button>
                </a>
                <a href="{{ route('register') }}">
                    <x-primary-button class="ms-4">
                        {{ __('Sign up') }}
                    </x-primary-button>
                </a>
                @endguest
                </div>
    </div>
</nav>
