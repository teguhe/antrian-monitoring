<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $fillable = [
        'tenant_nama',
        'tenant_urusan',
        'tenant_prefix',
        'tenant_aktif',
        'tenant_image',
        'tenant_keterangan',
        'created_by'
    ];
}
