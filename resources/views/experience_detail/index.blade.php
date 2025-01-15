<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Experience Details') }}
        </h2>
    </x-slot>

    <div class="px-6 py-2">
    <div class="flex justify-between items-center mt-10">
        
        <a href="{{ route('experiences.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">Create New Experience</a>

<div class="flex items-center">
        
        <form method="GET" action="{{ route('experiences.index') }}" class="flex items-center">
            <div class="w-64 relative mr-2"> <!-- Perpanjang dengan w-64 -->
                <input type="text" name="search" id="search" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 pr-10" value="{{ request('search') }}" placeholder="Search...">
                <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-blue-500 hover:text-blue-600">
                    <i class="fa fa-search"></i> <!-- Gunakan ikon pencarian Font Awesome -->
                </button>
            </div>

            <div class="w-64"> <!-- Perpanjang dengan w-64 -->
                <select name="category" id="category" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="" {{ !request('category') ? 'selected' : '' }}>Category</option>
                    <option value="Travel Arrangement" {{ request('category') == 'Travel Arrangement' ? 'selected' : '' }}>Travel Arrangement</option>
                    <option value="Marchandise/ATK" {{ request('category') == 'Marchandise/ATK' ? 'selected' : '' }}>Marchandise/ATK</option>
                    <option value="Business Development" {{ request('category') == 'Business Development' ? 'selected' : '' }}>Business Development</option>
                    <option value="IT" {{ request('category') == 'IT' ? 'selected' : '' }}>IT</option>
                    <option value="Manpower Supply" {{ request('category') == 'Manpower Supply' ? 'selected' : '' }}>Manpower Supply</option>
                    <option value="Event Organizer" {{ request('category') == 'Event Organizer' ? 'selected' : '' }}>Event Organizer</option>
                    <option value="Printing" {{ request('category') == 'Printing' ? 'selected' : '' }}>Printing</option>
                    <option value="Car Rental" {{ request('category') == 'Car Rental' ? 'selected' : '' }}>Car Rental</option>
                    <option value="Company Loan" {{ request('category') == 'Company Loan' ? 'selected' : '' }}>Company Loan</option>
                    <option value="Rent Building" {{ request('category') == 'Rent Building' ? 'selected' : '' }}>Rent Building</option>
                </select>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition">Apply</button>
        </form>

    <div class="dropdown ml-2">
        <!-- Dropdown Toggle Button -->
        <button class="dropdown-toggle bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition ml-4 w-full md:w-auto" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Actions
        </button>

        <!-- Dropdown Menu -->
        <ul class="dropdown-menu w-full min-w-[200px] mt-2 shadow-lg rounded-md bg-white ring-1 ring-gray-200 z-10" aria-labelledby="dropdownMenuButton">
            <!-- Download All Button -->
            <li>
                <a href="{{ route('experiences.pdfAll', ['search' => request('search'), 'category' => request('category')]) }}" class="dropdown-item px-4 py-2 text-gray-700 hover:bg-gray-100">Download All</a>
            </li>

            <!-- Export Projects -->
            <li>
                <a href="{{ route('experiences.export') }}" class="dropdown-item px-4 py-2 text-gray-700 hover:bg-gray-100">Export Pfs</a>
            </li>
        </ul>
    </div>

    <div class="ml-2">
        <button type="button" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition" data-bs-toggle="modal" data-bs-target="#importModal">
            Import
        </button>

        <!-- Modal untuk meng-upload file -->
        <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="importModalLabel">Upload File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('experiences.import') }}" method="POST" enctype="multipart/form-data" id="importForm">
                    @csrf
                    <div class="mb-3">
                        <label for="file" class="form-label text-sm text-gray-700">Select File</label>
                        <input type="file" id="file" name="file" class="form-control mt-1 block w-full text-sm text-gray-700" required>
                    </div>
                    <button type="submit" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition w-full">Import</button>
                    </form>
                </div>
                </div>
            </div>
            </div>

            <!-- Success Toast Notification -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3" id="successToast">
                <div id="liveToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            File berhasil diimport!
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

    </div>

</div>


        
    </div>
</div>




<div class="w-full mx-auto py-2 px-6">
    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto ">
            <thead class="bg-gray-200 ">
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
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Amount Contract</th>

                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Images</th>
                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Actions</th>
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
                        <td class="px-6 py-3 text-sm">Rp.{{ $experienceDetail->amount }}</td>
                   



                        <td class="">
                            @foreach($experienceDetail->images as $image)
                                <img src="{{ Storage::url($image->foto) }}" alt="Image" class="w-20 h-20 object-cover rounded-md mb-2">
                            @endforeach
                        </td>
                        <td class="px-6 py-3 text-sm">
                            <x-dropdown>
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                        <div>Action</div>
                                        <div class="ms-1">
                                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>
                                <x-slot name="content">
                                    <x-dropdown-link :href="route('experiences.edit', $experienceDetail->id)">
                                       Edit
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('experiences.pdffs', $experienceDetail->id)" target="_blank">
                                        Download FactSheet
                                    </x-dropdown-link>
                                    
                                    <x-dropdown-link :href="route('experiences.bast', $experienceDetail->id)" target="_blank">
                                        Download BAST
                                    </x-dropdown-link>

                                    <form method="POST" action="{{ route('experiences.destroy', $experienceDetail->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <x-dropdown-link :href="route('experiences.destroy', $experienceDetail->id)" onclick="event.preventDefault(); this.closest('form').submit();">
                                            Delete
                                        </x-dropdown-link>
                                    </form>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<!-- Pagination -->
{{ $experiences->links() }}

    </div>
</x-app-layout>
