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
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Password <span class="text-gray-500 text-sm">(kosongkan jika tidak ingin ubah)</span></label>
                        <input type="password" name="password" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="w-full border rounded p-2">
                    </div>

                    <div class="mb-4">
                        <label class="block">Role</label>
                        <select name="role" class="w-full border rounded p-2">
                            <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
