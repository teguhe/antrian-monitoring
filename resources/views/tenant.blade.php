<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Tenant - Antrian MPP</title>
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
        <div class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap">
                <input type="text" id="cariTenant" placeholder="Cari nama tenant / prefix..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select id="filterStatus" class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Non Aktif</option>
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
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nama Tenant</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Urusan</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Prefix</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($tenants as $no => $tenant)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $no + 1 }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-blue-700 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($tenant->tenant_nama, 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $tenant->tenant_nama }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $tenant->tenant_urusan }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 font-mono font-semibold">{{ $tenant->tenant_prefix }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($tenant->tenant_aktif == 1)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Non Aktif</span>
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
    document.addEventListener('DOMContentLoaded', function() {
        const inputCari = document.getElementById('cariTenant');
        const filterStatus = document.getElementById('filterStatus');
        const barisTabel = document.querySelectorAll('tbody tr');

        function filterData() {
            const kataKunci = inputCari.value.toLowerCase().trim();
            const statusPilih = filterStatus.value;

            barisTabel.forEach(baris => {
                const teksBaris = baris.textContent.toLowerCase();
                const statusBaris = baris.querySelector('span:nth-last-child(2)')?.textContent.trim() || '';

                const cocokCari = !kataKunci || teksBaris.includes(kataKunci);
                const cocokStatus = statusPilih === 'Semua Status' || statusBaris === statusPilih;

                baris.style.display = (cocokCari && cocokStatus) ? '' : 'none';
            });
        }

        inputCari.addEventListener('input', filterData);
        filterStatus.addEventListener('change', filterData);
    });
</script>

</body>
</html>

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

