<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Antrian - MPP Salatiga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100vh; overflow: hidden; }
        .number-display { font-feature-settings: 'tnum'; letter-spacing: 0.02em; }
    </style>
</head>
<body class="h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg">
        <div class="container mx-auto px-2 text-center">
            <h1 class="text-2xl font-bold tracking-wide uppercase">
                MONITORING ANTRIAN LAYANAN
            </h1>
            <p class="mt-0.5 text-blue-100 text-base" id="waktu">Memuat waktu...</p>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow w-full px-4 py-4">
        <div class="grid grid-cols-6 grid-rows-5 gap-1.5 h-full w-full" id="grid-antrian">
            <!-- Daftar counter antrian akan di render disini -->
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-800 text-slate-400 py-3">
        <div class="container mx-auto px-2 text-center text-xs">
            © {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga | Terakhir diperbarui: <span id="last-update">-</span>
        </div>
    </footer>

    <script>
        const tenants = [
            { id: 1, name: 'Penduduk', desc: 'Kependudukan' },
            { id: 2, name: 'Pajak', desc: 'Pajak Daerah' },
            { id: 3, name: 'Kesehatan', desc: 'Pelayanan Kesehatan' },
            { id: 4, name: 'Pendidikan', desc: 'Pendidikan' },
            { id: 5, name: 'Perizinan', desc: 'Izin Usaha' },
            { id: 6, name: 'Keuangan', desc: 'Keuangan Daerah' },
            { id: 7, name: 'Pertanahan', desc: 'BPN & Tanah' },
            { id: 8, name: 'Perhubungan', desc: 'Perhubungan' },
            { id: 9, name: 'Pekerjaan', desc: 'Tenaga Kerja' },
            { id: 10, name: 'Sosial', desc: 'Sosial & Bansos' },
            { id: 11, name: 'Pangan', desc: 'Ketahanan Pangan' },
            { id: 12, name: 'Pertanian', desc: 'Pertanian' },
            { id: 13, name: 'Perikanan', desc: 'Kelautan' },
            { id: 14, name: 'Lingkungan', desc: 'LHKB' },
            { id: 15, name: 'Pariwisata', desc: 'Pariwisata' },
            { id: 16, name: 'Komunikasi', desc: 'Kominfo' },
            { id: 17, name: 'Perpustakaan', desc: 'Perpustakaan' },
            { id: 18, name: 'Olahraga', desc: 'Kepemudaan' },
            { id: 19, name: 'Pemberdayaan', desc: 'PMD' },
            { id: 20, name: 'Pemerintahan', desc: 'Pemerintahan' },
            { id: 21, name: 'Hukum', desc: 'Hukum & HAM' },
            { id: 22, name: 'Inspektorat', desc: 'Inspektorat' },
            { id: 23, name: 'RSUD', desc: 'RSUD Kota' },
            { id: 24, name: 'PU', desc: 'Pekerjaan Umum' },
            { id: 25, name: 'PDAM', desc: 'Air Minum' },
            { id: 26, name: 'PLN', desc: 'Listrik' },
            { id: 27, name: 'Jasa Raharja', desc: 'Jasa Raharja' },
            { id: 28, name: 'BPJS', desc: 'BPJS Kesehatan' },
            { id: 29, name: 'BNI', desc: 'Bank BNI' },
            { id: 30, name: 'Polisi', desc: 'Polres Kota' },
        ];

        let antrianData = {};

        function init() {
            tenants.forEach(t => {
                antrianData[t.id] = {
                    current: Math.floor(Math.random() * 15) + 1,
                    waiting: Math.floor(Math.random() * 25),
                    done: Math.floor(Math.random() * 40)
                }
            });

            render();
            updateClock();
            setInterval(updateClock, 1000);
            setInterval(updateAntrian, 5000);
        }

        function render() {
            const grid = document.getElementById('grid-antrian');
            grid.innerHTML = '';

            tenants.forEach(t => {
                const data = antrianData[t.id];

                grid.innerHTML += `
                <div class="bg-white rounded-md shadow-sm border border-slate-200 overflow-hidden flex flex-col">
                    <div class="p-2 flex flex-col items-center justify-center flex-grow">
                        <h3 class="text-sm font-semibold text-slate-800 text-center leading-tight">${t.name}</h3>
                        <p class="text-xs text-slate-500 mt-0.5 text-center">${t.desc}</p>
                        <div class="text-4xl font-black text-blue-700 number-display mt-2">${String(data.current).padStart(3, '0')}</div>
                    </div>
                </div>
                `;
            });

            document.getElementById('last-update').textContent = new Date().toLocaleTimeString('id-ID');
        }

        function updateClock() {
            const now = new Date();
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
            document.getElementById('waktu').textContent = now.toLocaleDateString('id-ID', options);
        }

        function updateAntrian() {
            Object.keys(antrianData).forEach(id => {
                if (Math.random() > 0.7) {
                    antrianData[id].current++;
                    antrianData[id].done++;
                    if (antrianData[id].waiting > 0) antrianData[id].waiting--;
                }
                if (Math.random() > 0.85) {
                    antrianData[id].waiting++;
                }
            });

            render();
        }

        document.addEventListener('DOMContentLoaded', init);
    </script>
</body>
</html>
