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

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tenant_nama' => 'required|string|max:255',
            'tenant_urusan' => 'nullable|string|max:255',
            'tenant_prefix' => 'required|string|max:5',
            'tenant_keterangan' => 'nullable|string',
            'tenant_aktif' => 'nullable|in:1',
        ]);

        $tenant = Tenant::create([
            'tenant_nama' => $validated['tenant_nama'],
            'tenant_urusan' => $validated['tenant_urusan'] ?? null,
            'tenant_prefix' => strtoupper($validated['tenant_prefix']),
            'tenant_keterangan' => $validated['tenant_keterangan'] ?? null,
            'tenant_aktif' => $request->has('tenant_aktif') ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tenant berhasil ditambahkan'
        ]);
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($id);

        $validated = $request->validate([
            'tenant_nama' => 'required|string|max:255',
            'tenant_urusan' => 'nullable|string|max:255',
            'tenant_prefix' => 'required|string|max:5',
            'tenant_keterangan' => 'nullable|string',
            'tenant_aktif' => 'nullable|in:1',
        ]);

        $tenant->update([
            'tenant_nama' => $validated['tenant_nama'],
            'tenant_urusan' => $validated['tenant_urusan'] ?? null,
            'tenant_prefix' => strtoupper($validated['tenant_prefix']),
            'tenant_keterangan' => $validated['tenant_keterangan'] ?? null,
            'tenant_aktif' => $request->has('tenant_aktif') ? 1 : 0,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tenant berhasil diupdate'
        ]);
    }

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($id);
        $tenant->delete();

        return response()->json(['success' => true, 'message' => 'Tenant berhasil dihapus']);
    }
}
