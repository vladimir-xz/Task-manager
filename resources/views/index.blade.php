<x-app-layout>
    <x-slot name="header">
        <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
            {{ __('Hello from Hexlet!')}}
        </h1>
    </x-slot>

    <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
        {{ __('This is a simple task manager on Laravel') }}
    </p>
    <div class="space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
        <a href="https://hexlet.io" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow" target="_blank">
        {{ __('Press me')}}
        </a>
    </div>
</x-app-layout>
