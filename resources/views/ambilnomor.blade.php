<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ambil Nomor Antrian - MPP Salatiga</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100vh; overflow: hidden; }
    </style>
</head>
<body class="h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-6 shadow-lg">
        <div class="container mx-auto px-2 text-center">
            <h1 class="text-2xl font-bold tracking-wide uppercase">
                APLIKASI ANTRIAN MPP SALATIGA
            </h1>
            <p class="mt-0.5 text-blue-100 text-base">Kota Salatiga, Jawa Tengah</p>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="flex-grow w-full px-8 py-8">
        <div class="grid grid-cols-6 grid-rows-5 gap-1.5 h-full w-full">
            @foreach ($tenants as $tenant)
                <div class="bg-white rounded-md shadow-sm hover:shadow-md transition-all duration-200 cursor-pointer hover:scale-101 border border-slate-200 overflow-hidden flex flex-col">
                    <div class="p-1.5 flex flex-col items-center justify-center flex-grow">
                        {{-- Logo Rounded --}}
                        <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center mb-1 border border-blue-200">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        
                        {{-- Nama Tenant --}}
                        <h3 class="text-sm font-semibold text-slate-800 text-center leading-tight">
                            {{ $tenant['name'] }}
                        </h3>

                        {{-- Keterangan --}}
                        <p class="text-xs text-slate-500 mt-0.5 text-center leading-tight">
                            {{ $tenant['desc'] }}
                        </p>
                    </div>

                    {{-- Action Bar --}}
                    <div class="bg-blue-50 px-1 py-1 text-center border-t border-blue-100">
                        <button class="w-full text-blue-700 text-[10px] font-medium hover:text-blue-900">
                            Ambil
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-800 text-slate-400 py-4">
        <div class="container mx-auto px-2 text-center text-xs">
            <p>© {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga</p>
        </div>
    </footer>

</body>
</html>
