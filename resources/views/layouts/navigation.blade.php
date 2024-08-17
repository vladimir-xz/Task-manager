<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 py-2.5 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="flex items-center justify-between max-w-screen-xl mx-auto py-3 px-4 sm:px-6 lg:px-8">
                <!-- Logo -->
                <a class="flex items-center" href="{{ route('dashboard') }}">
                    <x-application-logo class="text-xl text-gray-800 dark:text-gray-200" />
                </a>

                <!-- Navigation Links -->
                <div class="items-center justify-between w-full flex flex-initial lg:w-auto space-x-8 -my-px ms-10 ">
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
                    <div class="flex flex-inline">

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
