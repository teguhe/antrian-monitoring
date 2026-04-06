{{-- Header Admin Template Universal --}}
<header class="bg-gradient-to-r from-blue-700 to-blue-800 text-white py-5 shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold tracking-wide uppercase">
                {{ $title ?? 'Halaman Admin' }}
            </h1>

            @isset($rightButton)
                {!! $rightButton !!}
            @endisset

            <div class="flex items-center gap-4">
                <span>Halo, {{ auth()->check() ? auth()->user()->name : 'Admin' }}</span>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1.5 rounded text-sm">Logout</button>
                </form>
            </div>
        </div>
    </div>
</header>
