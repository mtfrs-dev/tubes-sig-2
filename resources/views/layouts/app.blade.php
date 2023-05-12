<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        
        <!-- LEAFLET CSS --> 
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" 
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" 
            crossorigin="" />
        <link rel="stylesheet" href="{{ asset('css/leaflet-routing-machine.css') }}">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-slate-200 font-roboto">
            @include('layouts.navigation')

            <div class="flex overflow-hidden flex-col flex-1">
                @include('layouts.header')

                <main class="overflow-y-auto overflow-x-hidden flex-1 bg-slate-200">
                    <div class="container px-6 py-8 mx-auto">
                        @if (isset($header))
                            <h3 class="mb-4 text-3xl font-medium text-gray-700">
                                {{ $header }}
                            </h3>
                        @endif

                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <!-- LEAFLET JS --> 
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" 
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" 
            crossorigin=""></script>
        <script src="{{ asset('js/leaflet-routing-machine.js') }}"></script>
        <!-- JQUERY --> 
        <script src="https://code.jquery.com/jquery-3.6.4.min.js" 
            integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" 
            crossorigin="anonymous"></script>
    </body>
</html>
