<x-app-layout>
<div class="container mx-auto py-6">
    <h1 class="text-2xl font-semibold mb-4">Create New Experience Detail</h1>

    <!-- Form to create a new experience detail -->
    <form method="POST" action="{{ route('experiences.store') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div>
            <label for="category" class="block text-sm font-medium text-gray-700">Category</label>
            <input type="text" name="category" id="category" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
            <input type="text" name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="project_no" class="block text-sm font-medium text-gray-700">Project No</label>
            <input type="text" name="project_no" id="project_no" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="project_name" class="block text-sm font-medium text-gray-700">Project Name</label>
            <input type="text" name="project_name" id="project_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="client_name" class="block text-sm font-medium text-gray-700">Client Name</label>
            <input type="text" name="client_name" id="client_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="durations" class="block text-sm font-medium text-gray-700">Durations</label>
            <input type="text" name="durations" id="durations" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="date_project_start" class="block text-sm font-medium text-gray-700">Start Date</label>
            <input type="date" name="date_project_start" id="date_project_start" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="date_project_end" class="block text-sm font-medium text-gray-700">End Date</label>
            <input type="date" name="date_project_end" id="date_project_end" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="locations" class="block text-sm font-medium text-gray-700">Location</label>
            <input type="text" name="locations" id="locations" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="kbli_number" class="block text-sm font-medium text-gray-700">KBLI Number</label>
            <input type="text" name="kbli_number" id="kbli_number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <div>
            <label for="scope_of_work" class="block text-sm font-medium text-gray-700">Scope of Work</label>
            <textarea name="scope_of_work" id="scope_of_work" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        <div>
            <label for="image" class="block text-sm font-medium text-gray-700">Upload Images</label>
            <input type="file" name="image[]" id="image" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" multiple>
        </div>

        <button type="submit" class="mt-4 w-full bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">Create Experience Detail</button>
    </form>
</div>
</x-app-layout>
