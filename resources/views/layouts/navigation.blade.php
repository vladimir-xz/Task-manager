<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-2.5 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a class="flex items-center" href="{{ route('dashboard') }}">
                    <x-application-logo class="text-xl text-gray-800 dark:text-gray-200" />
                </a>

                <!-- Navigation Links -->
                <div class="items-center justify-between w-full flex lg:w-auto lg:order-1 space-x-8 -my-px ms-10 ">
                    <ul class="flex flex-row ms-4 font-medium space-x-8">
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


                <div class="flex flex-inline items-center justify-between">
                    <div class="flex flex-inline p-5">
                        
                        <button id="dropdownHoverButton" data-dropdown-toggle="dropdownHover" data-dropdown-trigger="hover" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-10 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">{{ __('Language')}} <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                        </button>

                        <!-- Dropdown menu -->
                        <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                            <li>
                                <a href="{{ route('local', 'en')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('English') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('local', 'ru')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">{{ __('Russian') }}</a>
                            </li>
                            </ul>
                        </div>

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
            
    </div>
</nav>
