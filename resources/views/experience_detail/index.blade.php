<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Experience Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-semibold mb-4">Experience Details</h1>

        <a href="{{ route('experiences.create') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md mb-4">Create New Experience</a>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">#</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project No</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Project Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500">Client Name</th>
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
                            <td class="px-6 py-3 text-sm">{{ $experienceDetail->status }}</td>
                            <td class="px-6 py-3 text-sm">
                                @foreach($experienceDetail->images as $image)
                                    <img src="{{ Storage::url($image->foto) }}" alt="Image" class="w-20 h-20 object-cover rounded-md mb-2">
                                @endforeach
                            </td>
                            <td class="px-6 py-3 text-sm">
                                <a href="{{ route('experiences.edit', $experienceDetail->id) }}" class="inline-block text-yellow-600 hover:text-yellow-800 mr-2">Edit</a>
                                <a href="{{ route('experiences.pdffs', $experienceDetail->id) }}" class="inline-block text-yellow-600 hover:text-yellow-800 mr-2">download fach sheet</a>

                                <form action="{{ route('experiences.destroy', $experienceDetail->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this record?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
