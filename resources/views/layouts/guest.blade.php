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
                
                <div class="flex items-center justify-center min-h-screen ">
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-md overflow-hidden rounded-xl p-6 sm:p-8">
        
        <!-- Logo -->
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('images/ISOLUTIONS.png') }}" alt="Logo ISolutions" class="w-40 h-auto">
            </a>
        </div>

        <!-- Slot (form login/register) -->
        <div>
            {{ $slot }}
        </div>
    </div>

            </div>
        </div>
    </body>
</html>
