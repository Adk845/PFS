<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
         {{-- favivons --}}
         <link rel="icon" type="image/x-icon" href="{{ asset('images/isologo.png') }}">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div style="background-image: url({{ asset('images/background1.jpg'); }})">
            <div style="background: rgba(0, 0, 0, 0.342)" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0  dark:bg-gray-900">
                
                <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                    <div class="bg-white rounded-md p-3 flex justify-center">
                        <a href="/">
                            <img src="{{ asset('images/ISOLUTIONS.png') }}" alt="logo isol" width="180">
                        </a>
                    </div>
        
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
