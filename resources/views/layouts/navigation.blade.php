<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-2.5 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a class="flex items-center" href="{{ route('dashboard') }}">
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
                <div class="flex items-center lg:order-2 sm:ms-5">
                @auth
                    <x-primary-link data-method="post" href="{{ route('logout')  }}">
                        {{ __('Logout') }}
                    </x-primary-link>
                @endauth
                
                @guest
                    <x-primary-link href="{{ route('login') }}">
                        {{ __('Login') }}
                    </x-primary-link>
                    <x-primary-link href="{{ route('register') }}" class="ml-2">
                        {{ __('Sign up') }}
                    </x-primary-link>
                @endguest
                </div>
    </div>
</nav>
