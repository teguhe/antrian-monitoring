<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Antrian Monitoring</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        #sidebar { transition: width 0.3s ease; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex min-h-screen">

        <!-- ========== SIDEBAR COLLAPSIBLE ========== -->
        <aside id="sidebar" class="w-64 bg-white shadow-lg flex-shrink-0">
            <div class="h-16 flex items-center justify-between px-4 border-b">
                <h2 id="sidebar-title" class="font-bold text-lg">📋 Antrian</h2>
                <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-800 text-xl">☰</button>
            </div>

            <nav class="p-3 space-y-1">
                <a href="/dashboard" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>📊</span> <span class="sidebar-text">Dashboard</span>
                </a>
                <a href="/user" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>👥</span> <span class="sidebar-text">Manajemen User</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>🏘️</span> <span class="sidebar-text">Manajemen Tenant</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>🏢</span> <span class="sidebar-text">Manajemen Loket</span>
                </a>
                <a href="/monitoring" target="_blank" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>🖥️</span> <span class="sidebar-text">Layar Monitoring</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>📈</span> <span class="sidebar-text">Laporan</span>
                </a>
                <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 text-gray-700">
                    <span>⚙️</span> <span class="sidebar-text">Pengaturan</span>
                </a>
            </nav>
        </aside>

        <!-- ========== MAIN CONTENT ========== -->
        <div class="flex-1 flex flex-col">

            <!-- TOP NAVBAR -->
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-6">
                <h1 class="font-bold text-gray-800">Dashboard Super Admin</h1>
                <div class="flex items-center gap-4">
                    <span>Halo, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm">Logout</button>
                    </form>
                </div>
            </header>

            <!-- PAGE CONTENT -->
            <main class="p-6">
                <!-- Statistik Box -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-6">
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-blue-600">0</div>
                        <div class="text-gray-500 text-sm">Total Antrian Hari Ini</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-green-600">0</div>
                        <div class="text-gray-500 text-sm">Sudah Selesai</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-orange-600">0</div>
                        <div class="text-gray-500 text-sm">Menunggu Antrian</div>
                    </div>
                    <div class="bg-white rounded-lg shadow p-5">
                        <div class="text-3xl font-bold text-purple-600">{{ \App\Models\User::count() }}</div>
                        <div class="text-gray-500 text-sm">Total User Operator</div>
                    </div>
                </div>
            </main>

        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const texts = document.querySelectorAll('.sidebar-text');
            const title = document.getElementById('sidebar-title');

            if (sidebar.classList.contains('w-64')) {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-16');
                texts.forEach(el => el.style.display = 'none');
                title.style.display = 'none';
            } else {
                sidebar.classList.remove('w-16');
                sidebar.classList.add('w-64');
                texts.forEach(el => el.style.display = 'block');
                title.style.display = 'block';
            }
        }
    </script>
</body>
</html>
