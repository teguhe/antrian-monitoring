<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantLoket extends Model
{
    protected $table = 'tenant_loket';
    protected $primaryKey = 'loket_id';
    public $timestamps = true;

    protected $fillable = [
        'loket_nama',
        'loket_nomor',
        'tenant_id',
        'loket_aktif',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
}
