<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT') 

                    <div class="mb-4">
                        <label class="block">Name</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Password (leave blank to keep current)</label>
                        <input type="password" name="password" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block font-semibold text-gray-800 dark:text-gray-200 mb-2">
                            Accessible Categories
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2">
                            @foreach($categories as $category)
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" 
                                           name="categories[]" 
                                           value="{{ $category->id }}"
                                           class="rounded text-indigo-600 focus:ring-indigo-500"
                                           {{ in_array($category->id, old('categories', $user->categories->pluck('id')->toArray())) ? 'checked' : '' }}>
                                    <span class="text-gray-700 dark:text-gray-300">{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block">Role</label>
                        <select name="role" class="w-full border rounded p-2">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <div class="flex space-x-3">
                       
                        <button type="submit" 
                                class="px-5 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            Update
                        </button>

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
