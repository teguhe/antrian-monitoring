<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/ambilnomor', function () {
    $tenants = [
        ['id' => 1, 'name' => 'Penduduk', 'desc' => 'Kependudukan'],
        ['id' => 2, 'name' => 'Pajak', 'desc' => 'Pajak Daerah'],
        ['id' => 3, 'name' => 'Kesehatan', 'desc' => 'Pelayanan Kesehatan'],
        ['id' => 4, 'name' => 'Pendidikan', 'desc' => 'Pendidikan'],
        ['id' => 5, 'name' => 'Perizinan', 'desc' => 'Izin Usaha'],
        ['id' => 6, 'name' => 'Keuangan', 'desc' => 'Keuangan Daerah'],

        ['id' => 7, 'name' => 'Pertanahan', 'desc' => 'BPN & Tanah'],
        ['id' => 8, 'name' => 'Perhubungan', 'desc' => 'Perhubungan'],
        ['id' => 9, 'name' => 'Pekerjaan', 'desc' => 'Tenaga Kerja'],
        ['id' => 10, 'name' => 'Sosial', 'desc' => 'Sosial & Bansos'],
        ['id' => 11, 'name' => 'Pangan', 'desc' => 'Ketahanan Pangan'],
        ['id' => 12, 'name' => 'Pertanian', 'desc' => 'Pertanian'],

        ['id' => 13, 'name' => 'Perikanan', 'desc' => 'Kelautan'],
        ['id' => 14, 'name' => 'Lingkungan', 'desc' => 'LHKB'],
        ['id' => 15, 'name' => 'Pariwisata', 'desc' => 'Pariwisata'],
        ['id' => 16, 'name' => 'Komunikasi', 'desc' => 'Kominfo'],
        ['id' => 17, 'name' => 'Perpustakaan', 'desc' => 'Perpustakaan'],
        ['id' => 18, 'name' => 'Olahraga', 'desc' => 'Kepemudaan'],

        ['id' => 19, 'name' => 'Pemberdayaan', 'desc' => 'PMD'],
        ['id' => 20, 'name' => 'Pemerintahan', 'desc' => 'Pemerintahan'],
        ['id' => 21, 'name' => 'Hukum', 'desc' => 'Hukum & HAM'],
        ['id' => 22, 'name' => 'Inspektorat', 'desc' => 'Inspektorat'],
        ['id' => 23, 'name' => 'RSUD', 'desc' => 'RSUD Kota'],
        ['id' => 24, 'name' => 'PU', 'desc' => 'Pekerjaan Umum'],

        ['id' => 25, 'name' => 'PDAM', 'desc' => 'Air Minum'],
        ['id' => 26, 'name' => 'PLN', 'desc' => 'Listrik'],
        ['id' => 27, 'name' => 'Jasa Raharja', 'desc' => 'Jasa Raharja'],
        ['id' => 28, 'name' => 'BPJS', 'desc' => 'BPJS Kesehatan'],
        ['id' => 29, 'name' => 'BNI', 'desc' => 'Bank BNI'],
        ['id' => 30, 'name' => 'Polisi', 'desc' => 'Polres Kota'],
    ];
    return view('ambilnomor', compact('tenants'));
});

Route::get('/monitoring', function () {
    return view('monitoring');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (\Illuminate\Http\Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    if (auth()->attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors([
        'email' => 'Email atau password salah.',
    ]);
});

use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\DashboardController;

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/user', UserController::class);
});

Route::post('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

Route::get('/about', function () {
    return view('about');
});
