<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, minimum-scale=1.0, initial-scale=1">
        <meta name="csrf-param" content="_token" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Task manager') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased min-h-screen" id="app">

        <header class="fixed w-full sm:mt:10">
            @include('layouts.navigation')
        </header>
        <!-- Page Heading -->
        <section class="bg-white dark:bg-gray-900 min-h-screen ">
            <div class="grid max-w-screen-xl px-4 pt-20 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:pt-28">
                @include('flash::message')
                    <div class="grid col-span-full">
                        @isset($header)
                            {{  $header }}
                        @endisset
                        
                        {{  $slot   }}
                    </div>
            </div>
        </section>
    </body>
</html>
