<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Experience Details') }}
        </h2>
    </x-slot>

    <div class="px-6 py-6">
    <form method="GET" action="{{ route('experiences.index') }}" class="mb-4">
    <div class="mb-4 flex space-x-4">
        <div class="w-1/3">
            <label for="search" class="block text-sm font-medium text-gray-700">Search</label>
            <input type="text" name="search" id="search" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" value="{{ request('search') }}" placeholder="Search experiences...">
        </div>
        
        <div class="w-1/3">
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <select name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                <option value="" {{ !request('category') ? 'selected' : '' }}>Choose category</option>

                <option value="Travel Arrangement" {{ request('category') == 'Travel Arrangement' ? 'selected' : '' }}>Travel Arrangement (Flight and Accommodations)</option>
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

        <div class="flex items-end">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
    </div>
</form>


        <div class="mb-4">
            <a href="{{ route('experiences.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Create New Experience</a>
            <a href="{{ route('experiences.pdfAll', [
    'search' => request('search'),
    'category' => request('category')
]) }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4" target="_blank">Download All</a>


</a>

        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
    <table class="min-w-full table-auto">
        <thead class="bg-gray-200">
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
                    <td class="px-6 py-3 text-sm grid grid-cols-3">
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
                                <x-dropdown-link :href="route('experiences.pdffs', $experienceDetail->id)">
                                   Download Fact Sheet
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

<!-- Pagination -->
{{ $experiences->links() }}

    </div>
</x-app-layout>
