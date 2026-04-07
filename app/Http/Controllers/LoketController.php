<?php

namespace App\Http\Controllers;

use App\Models\TenantLoket;
use Illuminate\Http\Request;

class LoketController extends Controller
{
    public function index(Request $request)
    {
        $lokets = TenantLoket::with('tenant');

        // Search by nama loket / tenant
        if ($request->filled('search')) {
            $keyword = $request->search;
            $lokets->where(function ($q) use ($keyword) {
                $q->where('loket_nama', 'like', '%' . $keyword . '%')
                  ->orWhereHas('tenant', function ($q2) use ($keyword) {
                      $q2->where('tenant_nama', 'like', '%' . $keyword . '%');
                  });
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $lokets->where('loket_aktif', $request->status);
        }

        $lokets = $lokets->paginate(10)->withQueryString();

        return view('loket', compact('lokets'));
    }

    public function destroy($id)
    {
        $loket = TenantLoket::findOrFail($id);
        $loket->delete();

        return response()->json(['success' => true, 'message' => 'Loket berhasil dihapus']);
    }
}
