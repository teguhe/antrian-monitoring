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
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold tracking-wide uppercase">
                    MANAJEMEN USER
                </h1>
                <button class="bg-white text-blue-700 hover:bg-blue-50 px-4 py-2 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah User
                </button>
            </div>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow container mx-auto px-4 py-6">

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap">
                <input type="text" placeholder="Cari nama / email..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Role</option>
                    <option>Admin</option>
                    <option>Operator</option>
                    <option>Viewer</option>
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
                                <div class="w-9 h-9 rounded-full bg-blue-700 text-white flex items-center justify-center font-bold">
                                    TP
                                </div>
                                <span class="font-medium text-slate-800">Teguh Prasetyo</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">admin@example.com</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-semibold">Admin</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">2 Apr 2026 13:15</td>
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

</body>
</html>
