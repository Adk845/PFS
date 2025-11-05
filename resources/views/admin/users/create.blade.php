<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block">Name</label>
                        <input type="text" name="name" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Email</label>
                        <input type="email" name="email" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Password</label>
                        <input type="password" name="password" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                    </div>

             

                            <div>
                        <label class="block font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Accessible Categories
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($categories as $category)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" 
                                           name="categories[]" 
                                           value="{{ $category->id }}"
                                           class="rounded text-indigo-600 focus:ring-indigo-500">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block">Role</label>
                        <select name="role" class="w-full border rounded p-2">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                    <!-- Save Button -->
                    <button type="submit" 
                        class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        Save
                    </button>

                    <!-- Cancel / Back Button -->
                    <a href="{{ route('admin.users') }}" 
                    class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                        Cancel
                    </a>
                </div>


                </form>
            </div>
        </div>
    </div>
</x-app-layout>
