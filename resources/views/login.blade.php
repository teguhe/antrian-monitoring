<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Antrian MPP</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { height: 100vh; }
    </style>
</head>
<body class="h-screen bg-gradient-to-br from-slate-50 to-slate-100 flex flex-col">

    {{-- Header --}}
    <header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg">
        <div class="container mx-auto px-2 text-center">
            <h1 class="text-2xl font-bold tracking-wide uppercase">
                LOGIN ADMINISTRATOR
            </h1>
        </div>
    </header>

    {{-- Login Container --}}
    <main class="flex-grow flex items-center justify-center px-4">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-xl shadow-lg border border-slate-200 p-8">

                <form method="POST" action="/login">
                    @csrf

                    @error('email')
                        <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                            {{ $message }}
                        </div>
                    @enderror

                    {{-- Email --}}
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Email</label>
                        <input type="email" name="email" value="admin@antrian.local" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan email">
                    </div>

                    {{-- Password --}}
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">Password</label>
                        <input type="password" name="password" class="w-full px-4 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Masukkan password">
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-semibold py-3 rounded-lg transition duration-200 shadow-md hover:shadow-lg">
                        MASUK
                    </button>
                </form>

            </div>

            <div class="text-center mt-6 text-slate-500 text-sm">
                Mal Pelayanan Publik Kota Salatiga
            </div>
        </div>
    </main>

    {{-- Footer --}}
    <footer class="bg-slate-800 text-slate-400 py-3">
        <div class="container mx-auto px-2 text-center text-xs">
            © {{ date('Y') }} Mal Pelayanan Publik Kota Salatiga
        </div>
    </footer>

</body>
</html>
