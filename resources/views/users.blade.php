<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User - Antrian MPP</title>
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
        @include('layouts.admin-header', ['title' => '👥 MANAJEMEN USER'])

        {{-- Main Content --}}
        <main class="flex-grow container mx-auto px-4 py-6">

            <!-- Tombol Action -->
            <div class="mb-5 flex justify-end">
                <button onclick="bukaModalTambah()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-lg font-semibold transition duration-200 shadow">
                    + Tambah User
                </button>
            </div>

        {{-- Filter & Search Bar --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 p-4 mb-6">
            <div class="flex gap-3 flex-wrap">
                <input type="text" id="cariUser" placeholder="Cari nama / email..." class="flex-grow px-4 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <select id="filterRole" class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Role</option>
                    <option>Super Admin</option>
                    <option>Admin</option>
                    <option>Admin Loket</option>
                </select>
                <select id="filterStatus" class="px-4 py-2 border border-slate-300 rounded-lg bg-white">
                    <option>Semua Status</option>
                    <option>Aktif</option>
                    <option>Non Aktif</option>
                </select>
            </div>
        </div>

        {{-- User Table --}}
        <div class="bg-white rounded-xl shadow border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200">
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Nama</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Email</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Role</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Status</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-slate-700">Login Terakhir</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-slate-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-full bg-gray-700 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 2)) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $user->name }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-slate-600">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-gray-100 text-gray-800 font-semibold">{{ $user->role }}</span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800 font-semibold">Aktif</span>
                        </td>
                        <td class="px-4 py-3 text-slate-500 text-sm">
                            {{ $user->last_login_at ? $user->last_login_at->format('d M Y H:i') : '-' }}
                        </td>
                        <td class="px-4 py-3 text-right">
                            <button class="text-blue-700 hover:text-blue-900 font-medium text-sm">Edit</button>
                            <span class="mx-2 text-slate-300">|</span>
                            @if($user->id == 1)
                                <button class="text-gray-400 cursor-not-allowed font-medium text-sm" disabled title="Super Admin tidak bisa dihapus">Hapus</button>
                            @else
                                <button onclick="hapusUser({{ $user->id }})" class="text-red-600 hover:text-red-800 font-medium text-sm">Hapus</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach

                    @if($users->isEmpty())
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-slate-500">
                            Belum ada user terdaftar
                        </td>
                    </tr>
                    @endif
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
        const inputCari = document.getElementById('cariUser');
        const filterRole = document.getElementById('filterRole');
        const filterStatus = document.getElementById('filterStatus');
        const barisTabel = document.querySelectorAll('tbody tr');

        function filterData() {
            const kataKunci = inputCari.value.toLowerCase().trim();
            const rolePilih = filterRole.value;
            const statusPilih = filterStatus.value;

            barisTabel.forEach(baris => {
                const teksBaris = baris.textContent.toLowerCase();
                const roleBaris = baris.querySelector('span:nth-child(2)')?.textContent.trim() || '';
                const statusBaris = baris.querySelector('span:nth-child(3)')?.textContent.trim() || '';

                const cocokCari = !kataKunci || teksBaris.includes(kataKunci);
                const cocokRole = rolePilih === 'Semua Role' || roleBaris === rolePilih;
                const cocokStatus = statusPilih === 'Semua Status' || statusBaris === statusPilih;

                baris.style.display = (cocokCari && cocokRole && cocokStatus) ? '' : 'none';
            });
        }

        inputCari.addEventListener('input', filterData);
        filterRole.addEventListener('change', filterData);
        filterStatus.addEventListener('change', filterData);
    });
</script>

<div id="modalTambahUser" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-xl shadow-xl w-full max-w-md p-6">
        <h3 class="text-lg font-bold text-slate-800 mb-4">➕ Tambah User Baru</h3>
        <form id="formTambahUser" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="email" name="email" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" required class="w-full px-3 py-2 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                <select name="role" required class="w-full px-3 py-2 border border-slate-300 rounded-lg bg-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="admin">Admin</option>
                    <option value="operator">Admin Loket</option>
                    <option value="viewer">Viewer</option>
                </select>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="tutupModalTambah()" class="flex-1 px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50">Batal</button>
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function bukaModalTambah() {
    document.getElementById('modalTambahUser').classList.remove('hidden');
}

function tutupModalTambah() {
    document.getElementById('formTambahUser').reset();
    document.getElementById('modalTambahUser').classList.add('hidden');
}

document.getElementById('formTambahUser').addEventListener('submit', function(e) {
    e.preventDefault();
    const data = new FormData(this);
    
    fetch('/user', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
            'Accept': 'application/json'
        },
        body: data
    }).then(res => {
        if(res.ok) {
            alert('✅ User berhasil ditambahkan!');
            tutupModalTambah();
            setTimeout(() => location.reload(), 300);
        } else {
            res.json().then(err => alert('❌ Gagal menambah user!\n' + JSON.stringify(err.errors)));
        }
    }).catch(err => alert('❌ Error koneksi'));
});

function hapusUser(id) {
    if(confirm("✅ Yakin mau hapus user ini?\n\nTindakan ini tidak bisa dikembalikan!")) {
        fetch("/user/" + id, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]").content,
                "Accept": "application/json",
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: "_method=DELETE"
        }).then(res => {
            if(res.ok) {
                setTimeout(() => location.reload(), 500);
            } else {
                alert("❌ Gagal menghapus user! Status: " + res.status);
            }
        }).catch(err => alert("❌ Error koneksi: " + err));
    }
}
</script>

</body>
</html>
