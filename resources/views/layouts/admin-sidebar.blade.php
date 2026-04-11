
<!-- ===== SIDEBAR ADMIN PARTIAL ===== -->
<aside id="sidebar" class="w-64 bg-white dark:bg-slate-800 shadow-lg flex-shrink-0 border-r border-slate-200 dark:border-slate-700">
    <div class="h-16 flex items-center justify-between px-4 border-b border-slate-200 dark:border-slate-700">
        <h2 id="sidebar-title" class="font-bold text-lg dark:text-white">📋 Antrian</h2>
        <button onclick="toggleSidebar()" class="text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 text-xl">☰</button>
    </div>

    <nav class="p-3 space-y-1">
        <a href="/dashboard" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 {{ request()->is('dashboard') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : '' }}">
            <span>📊</span> <span class="sidebar-text">Dashboard</span>
        </a>
        <a href="/user" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 {{ request()->is('user*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : '' }}">
            <span>👥</span> <span class="sidebar-text">Manajemen User</span>
        </a>
        <a href="/tenant" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 {{ request()->is('tenant') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : '' }}">
            <span>🏘️</span> <span class="sidebar-text">Manajemen Tenant</span>
        </a>
        <a href="/loket" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 {{ request()->is('loket*') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : '' }}">
            <span>🪑</span> <span class="sidebar-text">Manajemen Loket</span>
        </a>
        <a href="/monitoring" target="_blank" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200">
            <span>🖥️</span> <span class="sidebar-text">Layar Monitoring</span>
        </a>
        <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200">
            <span>📈</span> <span class="sidebar-text">Laporan</span>
        </a>
        <a href="#" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200">
            <span>⚙️</span> <span class="sidebar-text">Pengaturan</span>
        </a>
        <a href="/about" class="flex items-center gap-3 p-3 rounded hover:bg-blue-50 dark:hover:bg-slate-700 text-gray-700 dark:text-gray-200 {{ request()->is('about') ? 'bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400' : '' }}">
            <span>ℹ️</span> <span class="sidebar-text">Tentang Aplikasi</span>
        </a>
    </nav>
</aside>

<style> #sidebar { transition: width 0.3s ease; } </style>

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
