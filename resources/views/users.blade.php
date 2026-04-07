<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Antrian MPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex">

    {{-- Include Sidebar --}}
    @include('layouts.admin-sidebar')

    <div class="flex flex-col flex-1 min-h-screen">
        @include('layouts.admin-header', ['title' => '👥 MANAJEMEN USER'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Tombol Action -->
            <div class="mb-5 flex justify-end">
                <button onclick="bukaModalTambah()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah User
                </button>
            </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('user.index') }}" class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap items-center">
                {{-- Search --}}
                <div class="flex-1 min-w-[200px]">
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau email..." class="w-full pl-10 pr-4 py-2.5 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>
                {{-- Filter Role --}}
                <select name="role" onchange="this.form.submit()" class="px-3 py-2.5 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm min-w-[160px]">
                    <option value="all" {{ !request('role') || request('role') === 'all' ? 'selected' : '' }}>Semua Role</option>
                    <option value="superadmin" {{ request('role') === 'superadmin' ? 'selected' : '' }}>Super Admin</option>
                    <option value="admin" {{ request('role') === 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="admin_loket" {{ request('role') === 'admin_loket' ? 'selected' : '' }}>Admin Loket</option>
                </select>
                {{-- Filter Status --}}
                <select name="status" onchange="this.form.submit()" class="px-3 py-2.5 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm min-w-[160px]">
                    <option value="all" {{ !request('status') || request('status') === 'all' ? 'selected' : '' }}>Semua Status</option>
                    <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                {{-- Reset --}}
                <a href="{{ route('user.index') }}" class="px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 rounded-lg text-sm font-medium transition">
                    Reset
                </a>
            </div>
        </form>

        {{-- User Table --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-3 py-3 text-center text-sm font-semibold text-slate-700 w-16">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Login Terakhir</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $key => $user)
                    <tr class="hover:bg-slate-50 transition" data-role="{{ $user->role }}">
                        <td class="px-3 py-3 text-center font-semibold text-slate-500">{{ $loop->iteration }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gray-700 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 font-semibold">
                                @php
                                    $roleLabel = [
                                        'superadmin' => 'Super Admin',
                                        'admin' => 'Admin',
                                        'admin_loket' => 'Admin Loket',
                                    ];
                                @endphp
                                {{ $roleLabel[$user->role] ?? $user->role }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            @if($user->is_active)
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                            @else
                                <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">
                            {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if($user->role !== 'superadmin')
                                <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                                <span class="mx-2 text-slate-300">|</span>
                                <button onclick="hapusUser({{ $user->id }})" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                            @else
                                <span class="text-slate-300">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @if($users->isEmpty())
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-slate-500">
                            Belum ada user terdaftar
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </main>

        {{-- Footer --}}
        <footer class="bg-slate-800 text-slate-400 py-3">
            <div class="container mx-auto px-2 text-center text-xs">
                © {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga
            </div>
        </footer>
    </div>

<script>
</script>

<div id="modalTambahUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">➕ Tambah User Baru</h3>
        <form id="formTambahUser" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role" required class="w-full px-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin">
/option>

    </div>
</body>
</html>
