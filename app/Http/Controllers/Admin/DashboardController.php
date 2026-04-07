<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Middleware;
use Illuminate\Support\Facades\DB;

#[Middleware('auth')]
class DashboardController extends Controller
{
    public function index()
    {
        $totalOperator = DB::table('users')->count();
        return view('admin.dashboard', compact('totalOperator'));
    }
}
