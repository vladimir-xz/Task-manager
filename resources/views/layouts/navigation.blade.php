<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-2.5 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center md:justify-between max-w-screen-xl mx-auto py-3 px-4 sm:px-6 lg:px-8">


    <!-- Dropdown menu -->
            <div class="flex-none sm:items-center md:hidden sm:ms-6">
                <x-dropdown align="left" width="96">
                    <x-slot name="trigger">
                        <button class="md:hidden inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div class="ms-1">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                                    <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"></path>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-main-menu role="dropdown"/>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Logo -->
            <a class="flex items-center" href="{{ route('dashboard') }}">
                <x-application-logo class="ms-4 md:ms-0 text-xl text-gray-800 dark:text-gray-200" />
            </a>

                
                <!-- Navigation Links -->
            <div class="hidden md:flex md:items-center md:ms-6">
                <x-main-menu/>
            </div>


            <div class="hidden md:flex flex-inline items-center justify-between">
                <div class="flex-inline">

                    <x-lang-button/>
                    <!-- Dropdown menu -->
                    <div id="dropdownHover" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
                        <li>
                            <x-lang-link :href="route('local', 'eng')" :active="App::isLocale('eng')">
                                English
                            </x-lang-link>
                        </li>
                        <li>
                            <x-lang-link :href="route('local', 'ru')" :active="App::isLocale('ru')">
                                Русский
                            </x-lang-link>
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
