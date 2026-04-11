<!DOCTYPE html>
<html lang="id">
<head>
    <script>
        if (localStorage.getItem('theme') === 'dark') document.documentElement.classList.add('dark');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Loket - Antrian MPP</title>
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
        @include('layouts.admin-header', ['title' => '🪑 MANAJEMEN LOKET'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Tombol Action -->
            <div class="mb-5 flex justify-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah Loket
                </button>
            </div>

        {{-- Search & Filter --}}
        <form method="GET" action="{{ route('loket.index') }}" class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-4 mb-6">
            <div class="flex gap-3 flex-wrap items-center">
                {{-- Search --}}
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama loket / tenant..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

                {{-- Filter Status --}}
                <select name="status" class="px-4 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>

                {{-- Tombol Cari --}}
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition duration-200">
                    Cari
                </button>

                {{-- Reset --}}
                <a href="{{ route('loket.index') }}" class="bg-slate-200 hover:bg-slate-300 text-slate-700 dark:text-slate-200 px-5 py-2 rounded-lg font-semibold transition duration-200">
                    Reset
                </a>
            </div>
        </form>

        {{-- Loket Table --}}
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 dark:bg-slate-700 border-b border-slate-200 dark:border-slate-600">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Nama Loket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Tenant</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Nomor Loket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700 dark:text-slate-200">Status</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700 dark:text-slate-200">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($lokets as $loket)
                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        <td class="px-4 py-3 font-medium text-slate-700 dark:text-slate-200">{{ $lokets->firstItem() + $loop->index }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800 dark:text-white">{{ $loket->loket_nama }}</td>
                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $loket->tenant->tenant_nama ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 font-mono font-semibold">{{ $loket->loket_nomor }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($loket->loket_aktif == 1)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 font-semibold">Aktif</span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200 font-semibold">Nonaktif</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button onclick="hapusLoket({{ $loket->loket_id }})" class="text-red-700 hover:text-red-900 font-medium text-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- Pagination --}}
            @if($lokets->hasPages())
            <div class="px-4 py-3 border-t border-slate-200 dark:border-slate-600 flex items-center justify-between">
                <span class="text-sm text-slate-500 dark:text-slate-400 dark:text-slate-400">
                    Menampilkan {{ $lokets->firstItem() }}–{{ $lokets->lastItem() }} dari {{ $lokets->total() }} loket
                </span>
                {{ $lokets->appends(request()->query())->links() }}
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
function hapusLoket(id) {
    if(confirm('Yakin mau hapus loket ini?')) {
        fetch('/loket/' + id, {
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
