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
    <div class="w-full bg-blue-500 flex justify-center">
    @if (Route::has('login'))
        <div class="w-full mx-auto py-4 px-10 flex justify-between items-center h-16">
            <!-- Logo dengan kotak putih -->
            <div class="shrink-0 flex items-center bg-white p-4">
                <a href="{{ route('experiences.index') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-white dark:text-gray-200" />
                </a>
            </div>

            <!-- Menu Login/Register -->
            <div>
            @auth
                <a href="{{ url('/experiences') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-white hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
            </div>
        </div>
    @endif
</div>




<div class="w-full mx-auto py-6 px-10 mt-10"> 
    <h1 class="text-3xl font-semibold mb-6 text-left">Experience Details</h1>
    <div class="overflow-x-auto bg-white shadow-md rounded-lg w-full">
        <table class="min-w-full table-auto border-gray-300">
            <thead class="bg-gray-200 border-gray-300 ">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">No.</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project No</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Client Name</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">KBLI number</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Category</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Durations</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Period</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Locations</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Scope of Work</th>
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
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->kbli_number }}</td>
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->category }}</td>
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->durations }}</td>
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->date_project_start }} - {{ $experienceDetail->date_project_end }}</td>
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->locations }}</td>
                        <td class="px-6 py-3 text-sm">{{ $experienceDetail->scope_of_work }}</td>
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

            </div>
         
    </body>
    
</html>
