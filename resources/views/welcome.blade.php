<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>PFS Isolutions</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles -->
        
    </head>
    <body>
   
    <div class="max-h-max">
    @if (Route::has('login'))
        <div class="p-6 text-right bg-blue-500 flex justify-between items-center">
            <!-- Logo dengan kotak putih -->
            <a href="{{ url('/') }}" class="flex items-center">
                <div class="bg-white p-2 rounded-lg shadow-md">
                    <img src="{{ asset('images/isolutions.png') }}" alt="Logo" class="h-8">
                </div>
            </a>

            <!-- Menu Login/Register -->
            @auth
                <a href="{{ url('/experiences') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>


            <div class="container mx-auto py-6">
                <h1 class="text-2xl font-semibold mb-4">Experience Details</h1>

                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">No.</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Client Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Images</th>
                        
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @foreach($experiences as $experienceDetail)
                        <tr>
                            <td class="px-6 py-3 text-sm">{{ $loop->iteration }}</td>
                            <td class="px-6 py-3 text-sm">{{ $experienceDetail->project_no }}</td>
                            <td class="px-6 py-3 text-sm">{{ $experienceDetail->project_name }}</td>
                            <td class="px-6 py-3 text-sm">{{ $experienceDetail->client_name }}</td>
                            <td class="px-6 py-3 text-sm">{{ $experienceDetail->status }}</td>
                            <td class="px-6 py-3 text-sm grid grid-cols-3">
                                @foreach($experienceDetail->images as $image)
                                    <img src="{{ Storage::url($image->foto) }}" alt="Image" class="w-20 h-20 object-cover rounded-md mb-2">
                                @endforeach
                            </td>
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
            </div>
         
    </body>
    
</html>
