<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Loket - Antrian MPP</title>
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
        @include('layouts.admin-header', ['title' => '🪑 MANAJEMEN LOKET'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Tombol Action -->
            <div class="mb-5 flex justify-end">
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah Loket
                </button>
            </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap">
                <input type="text" id="cariLoket" placeholder="Cari nama loket / tenant..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select id="filterStatus" class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Non Aktif</option>
                </select>
            </div>
        </div>

        {{-- Loket Table --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">No</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nama Loket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Tenant</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nomor Loket</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($lokets as $no => $loket)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 font-medium text-slate-700">{{ $no + 1 }}</td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $loket->loket_nama }}</td>
                        <td class="px-4 py-3 text-slate-600">{{ $loket->tenant->tenant_nama ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 font-mono font-semibold">{{ $loket->loket_nomor }}</span>
                        </td>
                        <td class="px-4 py-3">
                            @if($loket->loket_aktif == 1)
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                            @else
                            <span class="px-2 py-1 text-xs rounded-full bg-red-100 text-red-800 font-semibold">Non Aktif</span>
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
        const inputCari = document.getElementById('cariLoket');
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
