<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Antrian MPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
    </style>
</head>
<body class="min-h-screen bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-900 dark:to-slate-800 flex">

    {{-- Include Sidebar --}}
    @include('layouts.admin-sidebar')

    <div class="flex flex-col flex-1 min-h-screen">
        @include('layouts.admin-header', ['title' => '📊 DASHBOARD ADMIN'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Total Tenant Aktif</p>
                            <p class="text-3xl font-bold text-slate-800 dark:text-white">12</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-400 flex items-center justify-center text-2xl">
                            🏢
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Antrian Hari Ini</p>
                            <p class="text-3xl font-bold text-slate-800 dark:text-white">87</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-400 flex items-center justify-center text-2xl">
                            🎫
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">User Petugas</p>
                            <p class="text-3xl font-bold text-slate-800 dark:text-white">34</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-400 flex items-center justify-center text-2xl">
                            👤
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 dark:text-slate-400 mb-1">Selesai Hari Ini</p>
                            <p class="text-3xl font-bold text-slate-800 dark:text-white">62</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 dark:bg-emerald-900 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity Table --}}
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
                <div class="px-4 py-3 border-b border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-700">
                    <h3 class="font-semibold text-slate-700 dark:text-slate-200">📌 Aktivitas Terbaru</h3>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-700 border-b border-slate-200 dark:border-slate-600">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Waktu</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Aksi</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Tenant</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Petugas</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">12:19 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">Panggil Nomor</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">Dukcapil</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">Budi</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">12:15 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">Ambil Nomor</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">BPJS Kesehatan</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">-</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 font-semibold">Menunggu</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">12:11 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">Lewati Nomor</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">Pajak</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">Ani</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-300 font-semibold">Dilewati</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">12:07 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">Panggil Nomor</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">BKN</td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-300">Joko</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 font-semibold">Selesai</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </main>

        {{-- Footer --}}
        <footer class="bg-slate-800 dark:bg-slate-950 text-slate-400 py-3">
            <div class="container mx-auto px-2 text-center text-xs">
                © {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga
            </div>
        </footer>
    </div>

</body>
</html>
