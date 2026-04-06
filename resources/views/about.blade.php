<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Aplikasi - Antrian MPP</title>
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
        {{-- Header --}}
        <header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg">
            <div class="container mx-auto px-4">
                <h1 class="text-xl font-bold tracking-wide uppercase">
                    📋 TENTANG APLIKASI
                </h1>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6 max-w-4xl">

            <div class="bg-white rounded-xl shadow border border-slate-200 p-8 space-y-6">

                <div class="text-center pb-6 border-b border-slate-200">
                    <div class="text-6xl mb-3">📋</div>
                    <h2 class="text-2xl font-bold text-slate-800">Sistem Antrian Digital MPP</h2>
                    <p class="text-slate-500">Mal Pelayanan Publik Kota Salatiga</p>
                    <div class="mt-2 inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">
                        Versi 1.0.0
                    </div>
                </div>

                <div class="space-y-4 text-slate-700 leading-relaxed">
                    <p>
                        <strong>Sistem Antrian Digital</strong> adalah aplikasi manajemen antrian terpadu yang dikembangkan untuk
                        memudahkan pelayanan masyarakat di Mal Pelayanan Publik Kota Salatiga.
                    </p>

                    <p>
                        Aplikasi ini menggantikan sistem antrian konvensional dengan sistem digital yang terintegrasi,
                        memungkinkan pengunjung mengambil nomor antrian secara digital, melihat status antrian secara realtime,
                        dan memantau waktu tunggu estimasi.
                    </p>

                    <h3 class="text-lg font-bold text-slate-800 pt-2">✨ Fitur Utama</h3>

                    <ul class="space-y-2 ml-5 list-disc">
                        <li>Pengambilan nomor antrian otomatis</li>
                        <li>Monitoring antrian realtime layar publik</li>
                        <li>Manajemen loket dan operator</li>
                        <li>Laporan statistik kunjungan dan waktu tunggu</li>
                        <li>Panggilan antrian dengan notifikasi suara</li>
                        <li>Multi tenant / SKPD</li>
                    </ul>

                    <h3 class="text-lg font-bold text-slate-800 pt-2">🏛️ Dibangun Oleh</h3>
                    <p>
                        Dinas Komunikasi dan Informatika Kota Salatiga<br>
                        Tahun Pengembangan: 2026
                    </p>

                    <div class="pt-4 text-center text-sm text-slate-500 border-t border-slate-200 mt-6">
                        © {{ date('Y') }} Pemerintah Kota Salatiga. Seluruh hak cipta dilindungi.
                    </div>
                </div>

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
