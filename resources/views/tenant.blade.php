<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tenant - Antrian MPP</title>
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
        @include('layouts.admin-header', ['title' => '🏢 MANAJEMEN TENANT'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Tombol Action -->
            <div class="mb-5 flex justify-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah Tenant
                </button>
            </div>

        {{-- Filter & Search Bar --}}
        <form method="GET" action="{{ route('tenant.index') }}" class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-4 mb-6">
            <div class="flex gap-3 flex-wrap items-center">
                <input type="text" name="search" placeholder="Cari nama tenant / prefix..." value="{{ request('search') }}" class="flex-grow min-w-[200px] px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="status" class="px-4 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition duration-200">
                    🔍 Cari
                </button>
                <a href="{{ route('tenant.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 dark:text-slate-200 px-4 py-2 rounded-lg font-medium transition duration-200">
                    ✖ Reset
                </a>
            </div>
        </form>

        {{-- Tenant Table --}}
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-700 border-b border-slate-200 dark:border-slate-600">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Nama Tenant</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Urusan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Prefix</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Status</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700 dark:text-slate-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($tenants as $no => $tenant)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        <td class="px-4 py-3 font-medium text-slate-700 dark:text-slate-200">{{ $tenants->firstItem() + $no }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-700 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($tenant->tenant_nama, 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800 dark:text-white">{{ $tenant->tenant_nama }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $tenant->tenant_urusan }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200 font-mono font-semibold">{{ $tenant->tenant_prefix }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($tenant->tenant_aktif == 1)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 font-semibold">Aktif</span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button onclick="hapusTenant({{ $tenant->tenant_id }})" class="text-red-700 hover:text-red-900 font-medium text-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($tenants->hasPages())
            <div class="flex justify-center items-center gap-1 px-4 py-3 border-t border-slate-200 dark:border-slate-600">
                {{ $tenants->links() }}
            </div>
            @endif
        </div>

    </main>

        {{-- Footer --}}
        <footer class="bg-slate-800 dark:bg-slate-950 text-slate-400 py-3">
            <div class="container mx-auto px-2 text-center text-xs">
                © {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga
            </div>
        </footer>
    </div>

<script>
function hapusTenant(id) {
    if(confirm('Yakin mau hapus tenant ini?')) {
        fetch('/tenant/' + id, {
            method: 'DELETE',
            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content}
        }).then(res => res.json()).then(data => {
            if(data.success) alert(data.message);
            location.reload();
        });
    }
}
</script>

</body>
</html>
