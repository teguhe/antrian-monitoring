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
                <button type="button" onclick="bukaModalTambah()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah Tenant
                </button>
            </div>

        {{-- Filter & Search Bar --}}
        <form method="GET" action="{{ route('tenant.index') }}" class="bg-white dark:bg-slate-800 rounded-xl shadow border border-slate-200 dark:border-slate-700 p-4 mb-6">
            <div class="flex gap-3 flex-wrap items-center">
                <input type="text" name="search" placeholder="Cari nama tenant / prefix..." value="{{ request('search') }}" class="flex-grow min-w-[200px] px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select name="status" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" {{ !request('status') ? 'selected' : '' }}>Semua Status</option>
                    <option value="aktif" {{ request('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ request('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-medium transition duration-200">
                    🔍 Cari
                </button>
                <a href="{{ route('tenant.index') }}" class="bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-700 dark:text-white px-4 py-2 rounded-lg font-medium transition duration-200">
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
                                <div class="w-9 h-9 rounded-full bg-blue-700 dark:bg-blue-600 text-white flex items-center justify-center font-bold">
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
                            <button type="button" onclick="editTenant({{ $tenant->tenant_id }}, '{{ addslashes($tenant->tenant_nama) }}', '{{ addslashes($tenant->tenant_urusan ?? '') }}', '{{ addslashes($tenant->tenant_prefix) }}', {{ $tenant->tenant_aktif }}, '{{ addslashes($tenant->tenant_keterangan ?? '') }}')" class="text-blue-700 dark:text-blue-400 hover:text-blue-900 dark:hover:text-blue-300 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            <button onclick="hapusTenant({{ $tenant->tenant_id }})" class="text-red-700 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium text-sm">Hapus</button>
                        </td>
                    </tr>
                    @endforeach

                    @if($tenants->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">
                            Belum ada tenant terdaftar
                        </td>
                    </tr>
                    @endif
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

{{-- ===================== MODAL TAMBAH TENANT ===================== --}}
<div id="modalTambah" class="fixed inset-0 bg-black/50 dark:bg-black/70 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-xl w-full max-w-lg mx-4">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">🏢 Tambah Tenant Baru</h3>
            <button type="button" onclick="tutupModalTambah()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-2xl leading-none">&times;</button>
        </div>
        <form id="formTambah" class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Nama Tenant <span class="text-red-500">*</span></label>
                <input type="text" name="tenant_nama" required placeholder="Contoh: Dinas Kependudukan"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Urusan</label>
                <input type="text" name="tenant_urusan" placeholder="Contoh: Kependudukan dan Pencatatan Sipil"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Prefix <span class="text-red-500">*</span></label>
                <input type="text" name="tenant_prefix" required placeholder="Contoh: DUK" maxlength="5"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Maksimal 5 karakter, contoh: DUK, BPN, PAJAK</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Keterangan</label>
                <textarea name="tenant_keterangan" rows="2" placeholder="Deskripsi singkat tenant..."
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="tenant_aktif" value="1" checked
                        class="w-5 h-5 rounded border-slate-300 dark:border-slate-600 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Tenant Aktif</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <button type="button" onclick="tutupModalTambah()" class="px-5 py-2.5 bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-700 dark:text-white rounded-lg font-medium transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                    💾 Simpan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ===================== MODAL EDIT TENANT ===================== --}}
<div id="modalEdit" class="fixed inset-0 bg-black/50 dark:bg-black/70 flex items-center justify-center z-50 hidden">
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-xl w-full max-w-lg mx-4">
        <div class="flex items-center justify-between px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <h3 class="text-lg font-bold text-slate-800 dark:text-white">✏️ Edit Tenant</h3>
            <button type="button" onclick="tutupModalEdit()" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-2xl leading-none">&times;</button>
        </div>
        <form id="formEdit" class="p-6 space-y-4">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="tenant_id" id="edit_tenant_id">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Nama Tenant <span class="text-red-500">*</span></label>
                <input type="text" name="tenant_nama" id="edit_tenant_nama" required placeholder="Contoh: Dinas Kependudukan"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Urusan</label>
                <input type="text" name="tenant_urusan" id="edit_tenant_urusan" placeholder="Contoh: Kependudukan dan Pencatatan Sipil"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Prefix <span class="text-red-500">*</span></label>
                <input type="text" name="tenant_prefix" id="edit_tenant_prefix" required placeholder="Contoh: DUK" maxlength="5"
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Maksimal 5 karakter</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Keterangan</label>
                <textarea name="tenant_keterangan" id="edit_tenant_keterangan" rows="2" placeholder="Deskripsi singkat tenant..."
                    class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 resize-none"></textarea>
            </div>
            <div>
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="tenant_aktif" id="edit_tenant_aktif" value="1"
                        class="w-5 h-5 rounded border-slate-300 dark:border-slate-600 text-blue-600 focus:ring-blue-500">
                    <span class="text-sm font-medium text-slate-700 dark:text-slate-200">Tenant Aktif</span>
                </label>
            </div>
            <div class="flex justify-end gap-3 pt-4 border-t border-slate-200 dark:border-slate-700">
                <button type="button" onclick="tutupModalEdit()" class="px-5 py-2.5 bg-slate-200 dark:bg-slate-600 hover:bg-slate-300 dark:hover:bg-slate-500 text-slate-700 dark:text-white rounded-lg font-medium transition">
                    Batal
                </button>
                <button type="submit" class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition">
                    💾 Update
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Modal Functions
function bukaModalTambah() {
    document.getElementById('modalTambah').classList.remove('hidden');
    document.getElementById('formTambah').reset();
}

function tutupModalTambah() {
    document.getElementById('modalTambah').classList.add('hidden');
}

function editTenant(id, nama, urusan, prefix, aktif, keterangan) {
    document.getElementById('modalEdit').classList.remove('hidden');
    document.getElementById('edit_tenant_id').value = id;
    document.getElementById('edit_tenant_nama').value = nama || '';
    document.getElementById('edit_tenant_urusan').value = urusan || '';
    document.getElementById('edit_tenant_prefix').value = prefix || '';
    document.getElementById('edit_tenant_keterangan').value = keterangan || '';
    document.getElementById('edit_tenant_aktif').checked = aktif == 1;
}

function tutupModalEdit() {
    document.getElementById('modalEdit').classList.add('hidden');
}

// Submit TAMBAH
document.getElementById('formTambah').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);

    fetch('/tenant', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            tutupModalTambah();
            location.reload();
        } else {
            alert(data.message || 'Gagal menyimpan');
        }
    })
    .catch(err => {
        alert('Error: ' + err.message);
    });
});

// Submit EDIT
document.getElementById('formEdit').addEventListener('submit', function(e) {
    e.preventDefault();
    const id = document.getElementById('edit_tenant_id').value;
    const form = document.getElementById('formEdit');
    const params = new URLSearchParams(new FormData(form));

    fetch('/tenant/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: params.toString()
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            tutupModalEdit();
            location.reload();
        } else {
            alert(data.message || 'Gagal mengupdate');
        }
    })
    .catch(err => {
        alert('Error: ' + err.message);
    });
});

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

// Close modal on backdrop click
['modalTambah', 'modalEdit'].forEach(id => {
    const el = document.getElementById(id);
    if (el) {
        el.addEventListener('click', function(e) {
            if (e.target === this) this.classList.add('hidden');
        });
    }
});
</script>

</body>
</html>
