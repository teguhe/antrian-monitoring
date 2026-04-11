{{-- Header Admin Template Universal --}}
<header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg dark:from-blue-900 dark:to-blue-950">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wide uppercase">
                {{ $title ?? 'Halaman Admin' }}
            </h1>

            @isset($rightButton)
                {!! $rightButton !!}
            @endisset

            <div class="flex items-center gap-3">
                {{-- Dark Mode Toggle --}}
                <button id="btnDarkMode" onclick="toggleDarkMode()" class="p-2 rounded-lg hover:bg-blue-600 transition" title="Toggle Dark Mode">
                    <span id="iconDark" class="text-xl">🌙</span>
                    <span id="iconLight" class="text-xl hidden">☀️</span>
                </button>
                <span class="hidden sm:inline">Halo, {{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>

{{-- Dark Mode Script --}}
<script>
    // Apply saved theme on load
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.classList.add('dark');
        document.getElementById('iconDark')?.classList.add('hidden');
        document.getElementById('iconLight')?.classList.remove('hidden');
    }

    function toggleDarkMode() {
        document.documentElement.classList.toggle('dark');
        const isDark = document.documentElement.classList.contains('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        document.getElementById('iconDark')?.classList.toggle('hidden', isDark);
        document.getElementById('iconLight')?.classList.toggle('hidden', !isDark);
    }
</script>
