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
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah User
                </button>
            </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap">
                <input type="text" placeholder="Cari nama / email..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Role</option>
                    <option>Super Admin</option>
                    <option>Admin</option>
                    <option>Admin Loket</option>
                </select>
                <select class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Nonaktif</option>
                </select>
            </div>
        </div>

        {{-- User Table --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Login Terakhir</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-purple-700 text-white flex items-center justify-center font-bold">
                                    TP
                                </div>
                                <span class="font-medium text-slate-800">Teguh Prasetyo</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">admin@example.com</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 font-semibold">Super Admin</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">2 Apr 2026 13:15</td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button class="text-gray-400 cursor-not-allowed font-medium text-sm" disabled title="Super Admin tidak bisa dihapus">Hapus</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-700 text-white flex items-center justify-center font-bold">
                                    AS
                                </div>
                                <span class="font-medium text-slate-800">Admin Aplikasi</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">admin.app@example.com</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">Admin</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">5 Apr 2026 09:05</td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                        </td>
                    </tr>
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-teal-700 text-white flex items-center justify-center font-bold">
                                    OL
                                </div>
                                <span class="font-medium text-slate-800">Operator Loket 01</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">loket01@example.com</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-teal-100 text-teal-800 font-semibold">Admin Loket</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">6 Apr 2026 07:45</td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                        </td>
                    </tr>
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

</body>
</html>
