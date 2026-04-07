<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index(Request $request)
    {
        $tenants = Tenant::query();

        // Search by nama tenant atau prefix
        if ($search = $request->input('search')) {
            $tenants->where(function ($q) use ($search) {
                $q->where('tenant_nama', 'like', "%{$search}%")
                  ->orWhere('tenant_prefix', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            if ($status === 'aktif') {
                $tenants->where('tenant_aktif', 1);
            } elseif ($status === 'nonaktif') {
                $tenants->where('tenant_aktif', 0);
            }
        }

        $tenants = $tenants->paginate(10)->withQueryString();

        return view('tenant', compact('tenants'));
    }

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return response()->json(['success' => true, 'message' => 'Tenant berhasil dihapus']);
    }
}
