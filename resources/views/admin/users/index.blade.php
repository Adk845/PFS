<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            {{-- Back Button --}}
            <a href="{{ route('experiences.index') }}" 
               class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                ← Back
            </a>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('User List') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Summary / Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total Users</h3>
                    <p class="text-2xl">{{ $users->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Logins Today</h3>
                    <p class="text-2xl">{{ $todayLogins->count() }}</p>
                    <button 
                        onclick="toggleTable('today-login-table')" 
                        class="mt-2 bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                        View Details
                    </button>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Actions</h3>
                        <p class="text-sm text-gray-500">Add a new user</p>
                    </div>
                    <a href="{{ route('users.create') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Create User
                    </a>
                </div>
            </div>

            {{-- All Users Table --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">All Users</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Created At</th>
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Role</th>
                            <th class="px-4 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $user)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $key + 1 }}</td>
                            <td class="px-4 py-2">{{ $user->created_at }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->role }}</td>
                            <td class="px-4 py-2 flex items-center space-x-4">
                                <!-- Edit Button -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                class="text-blue-600 hover:text-blue-800" 
                                title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>

                                <!-- Delete Button -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                    onsubmit="return confirm('Are you sure you want to delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                        <i class="fas fa-trash text-lg"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>

            {{-- Users Logged in Today (default hidden) --}}
            <div id="today-login-table" class="hidden bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Users Logged in Today</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Name</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Last Login</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($todayLogins as $user)
                            <tr class="border-b">
                                <td class="px-4 py-2">{{ $user->name }}</td>
                                <td class="px-4 py-2">{{ $user->email }}</td>
                                <td class="px-4 py-2">
                                    {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">No users logged in today</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <script>
        function toggleTable(id) {
            const el = document.getElementById(id);
            el.classList.toggle('hidden');
        }
    </script>
</x-app-layout>
