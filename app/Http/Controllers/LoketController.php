<?php

namespace App\Http\Controllers;

use App\Models\TenantLoket;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index()
    {
        $lokets = TenantLoket::with('tenant')->get();
        return view('loket', compact('lokets'));
    }

    public function destroy($id)
    {
        $loket = TenantLoket::findOrFail($id);
        $loket->delete();

        return response()->json(['success' => true, 'message' => 'Loket berhasil dihapus']);
    }
}
