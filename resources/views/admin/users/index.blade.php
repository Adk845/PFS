<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            {{-- Tombol Back --}}
            <a href="{{ route('experiences.index') }}" 
               class="bg-gray-600 text-white px-3 py-1 rounded hover:bg-gray-700">
                ← Back
            </a>

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Daftar User') }}
            </h2>
        </div>
    </x-slot>


    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Ringkasan / Card --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Total User</h3>
                    <p class="text-2xl">{{ $users->count() }}</p>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold">Login Hari Ini</h3>
                    <p class="text-2xl">{{ $todayLogins->count() }}</p>
                    <button 
                        onclick="toggleTable('today-login-table')" 
                        class="mt-2 bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                        Lihat Detail
                    </button>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold">Aksi</h3>
                        <p class="text-sm text-gray-500">Tambah user baru</p>
                    </div>
                    <a href="{{ route('users.create') }}" 
                       class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        Create User
                    </a>
                </div>
            </div>

            {{-- Tabel Semua User --}}
            <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Semua User</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">No</th>
                            <th class="px-4 py-2 text-left">Tanggal Dibuat</th>
                            <th class="px-4 py-2 text-left">Nama</th>
                            <th class="px-4 py-2 text-left">Email</th>
                            <th class="px-4 py-2 text-left">Role</th>
                           <th class="px-4 py-2 text-left">Aksi</th>
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
                                <!-- Tombol Edit -->
                                <a href="{{ route('admin.users.edit', $user->id) }}" 
                                class="text-blue-600 hover:text-blue-800" 
                                title="Edit">
                                    <i class="fas fa-edit text-lg"></i>
                                </a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" 
                                    onsubmit="return confirm('Yakin mau hapus user ini?')">
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

            {{-- Tabel User yang login hari ini (default hidden) --}}
            <div id="today-login-table" class="hidden bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">User Login Hari Ini</h3>
                <table class="table-auto w-full">
                    <thead>
                        <tr class="border-b">
                            <th class="px-4 py-2 text-left">Nama</th>
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
                                <td colspan="3" class="text-center py-4">Belum ada user login hari ini</td>
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
        