<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Antrian MPP</title>
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
        @include('layouts.admin-header', ['title' => '📊 DASHBOARD ADMIN'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                <div class="bg-white rounded-xl shadow border border-slate-200 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Total Tenant Aktif</p>
                            <p class="text-3xl font-bold text-slate-800">12</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center text-2xl">
                            🏢
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Antrian Hari Ini</p>
                            <p class="text-3xl font-bold text-slate-800">87</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-green-100 text-green-700 flex items-center justify-center text-2xl">
                            🎫
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">User Petugas</p>
                            <p class="text-3xl font-bold text-slate-800">34</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-700 flex items-center justify-center text-2xl">
                            👤
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl shadow border border-slate-200 p-5">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-1">Selesai Hari Ini</p>
                            <p class="text-3xl font-bold text-slate-800">62</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center text-2xl">
                            ✅
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Activity Table --}}
            <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
                <div class="px-4 py-3 border-b border-slate-200 bg-slate-50">
                    <h3 class="font-semibold text-slate-700">📌 Aktivitas Terbaru</h3>
                </div>
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-200">
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Waktu</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Aksi</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Tenant</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Petugas</th>
                            <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-slate-600 text-sm">12:19 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800">Panggil Nomor</td>
                            <td class="px-4 py-3 text-slate-600">Dukcapil</td>
                            <td class="px-4 py-3 text-slate-600">Budi</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Selesai</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-slate-600 text-sm">12:15 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800">Ambil Nomor</td>
                            <td class="px-4 py-3 text-slate-600">BPJS Kesehatan</td>
                            <td class="px-4 py-3 text-slate-600">-</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800 font-semibold">Menunggu</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-slate-600 text-sm">12:11 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800">Lewati Nomor</td>
                            <td class="px-4 py-3 text-slate-600">Pajak</td>
                            <td class="px-4 py-3 text-slate-600">Ani</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-orange-100 text-orange-800 font-semibold">Dilewati</span>
                            </td>
                        </tr>
                        <tr class="hover:bg-slate-50 transition">
                            <td class="px-4 py-3 text-slate-600 text-sm">12:07 WIB</td>
                            <td class="px-4 py-3 font-medium text-slate-800">Panggil Nomor</td>
                            <td class="px-4 py-3 text-slate-600">BKN</td>
                            <td class="px-4 py-3 text-slate-600">Joko</td>
                            <td class="px-4 py-3">
                                <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Selesai</span>
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
