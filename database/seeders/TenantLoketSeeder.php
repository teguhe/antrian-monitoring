<?php

namespace Database\Seeders;

use App\Models\TenantLoket;
use Illuminate\Database\Seeder;

class TenantLoketSeeder extends Seeder
{
    public function run()
    {
        $dataLoket = [
            ['loket_id' => 1, 'tenant_id' => 1, 'loket_nama' => 'Loket 1', 'loket_nomor' => '01', 'loket_aktif' => 1],
            ['loket_id' => 2, 'tenant_id' => 2, 'loket_nama' => 'Loket 2', 'loket_nomor' => '02', 'loket_aktif' => 1],
            ['loket_id' => 3, 'tenant_id' => 3, 'loket_nama' => 'Loket 3', 'loket_nomor' => '03', 'loket_aktif' => 1],
            ['loket_id' => 4, 'tenant_id' => 4, 'loket_nama' => 'Loket 4', 'loket_nomor' => '04', 'loket_aktif' => 1],
            ['loket_id' => 5, 'tenant_id' => 5, 'loket_nama' => 'Loket 5', 'loket_nomor' => '05', 'loket_aktif' => 1],
            ['loket_id' => 6, 'tenant_id' => 5, 'loket_nama' => 'Loket 6', 'loket_nomor' => '06', 'loket_aktif' => 1],
            ['loket_id' => 7, 'tenant_id' => 6, 'loket_nama' => 'Loket 7', 'loket_nomor' => '07', 'loket_aktif' => 1],
            ['loket_id' => 8, 'tenant_id' => 7, 'loket_nama' => 'Loket 8', 'loket_nomor' => '08', 'loket_aktif' => 1],
            ['loket_id' => 9, 'tenant_id' => 8, 'loket_nama' => 'Loket 9', 'loket_nomor' => '09', 'loket_aktif' => 1],
            ['loket_id' => 10, 'tenant_id' => 9, 'loket_nama' => 'Loket 10', 'loket_nomor' => '10', 'loket_aktif' => 1],
            ['loket_id' => 11, 'tenant_id' => 10, 'loket_nama' => 'Loket 11', 'loket_nomor' => '11', 'loket_aktif' => 1],
            ['loket_id' => 12, 'tenant_id' => 11, 'loket_nama' => 'Loket 12', 'loket_nomor' => '12', 'loket_aktif' => 1],
            ['loket_id' => 13, 'tenant_id' => 12, 'loket_nama' => 'Loket 13', 'loket_nomor' => '13', 'loket_aktif' => 1],
            ['loket_id' => 14, 'tenant_id' => 13, 'loket_nama' => 'Loket 14', 'loket_nomor' => '14', 'loket_aktif' => 1],
            ['loket_id' => 15, 'tenant_id' => 14, 'loket_nama' => 'Loket 15', 'loket_nomor' => '15', 'loket_aktif' => 1],
            ['loket_id' => 16, 'tenant_id' => 15, 'loket_nama' => 'Loket 16', 'loket_nomor' => '16', 'loket_aktif' => 1],
            ['loket_id' => 17, 'tenant_id' => 16, 'loket_nama' => 'Loket 17', 'loket_nomor' => '17', 'loket_aktif' => 1],
            ['loket_id' => 18, 'tenant_id' => 17, 'loket_nama' => 'Loket 18', 'loket_nomor' => '18', 'loket_aktif' => 1],
            ['loket_id' => 19, 'tenant_id' => 18, 'loket_nama' => 'Loket 19', 'loket_nomor' => '19', 'loket_aktif' => 1],
            ['loket_id' => 20, 'tenant_id' => 19, 'loket_nama' => 'Loket 20', 'loket_nomor' => '20', 'loket_aktif' => 1],
            ['loket_id' => 21, 'tenant_id' => 20, 'loket_nama' => 'Loket 21', 'loket_nomor' => '21', 'loket_aktif' => 1],
            ['loket_id' => 22, 'tenant_id' => 21, 'loket_nama' => 'Loket 22', 'loket_nomor' => '22', 'loket_aktif' => 1],
            ['loket_id' => 23, 'tenant_id' => 22, 'loket_nama' => 'Loket 23', 'loket_nomor' => '23', 'loket_aktif' => 1],
            ['loket_id' => 24, 'tenant_id' => 23, 'loket_nama' => 'Loket 24', 'loket_nomor' => '24', 'loket_aktif' => 1],
            ['loket_id' => 25, 'tenant_id' => 24, 'loket_nama' => 'Loket 25', 'loket_nomor' => '25', 'loket_aktif' => 1],
            ['loket_id' => 26, 'tenant_id' => null, 'loket_nama' => 'Loket 26', 'loket_nomor' => '26', 'loket_aktif' => 0],
            ['loket_id' => 27, 'tenant_id' => null, 'loket_nama' => 'Loket 27', 'loket_nomor' => '27', 'loket_aktif' => 0],
            ['loket_id' => 28, 'tenant_id' => null, 'loket_nama' => 'Loket 28', 'loket_nomor' => '28', 'loket_aktif' => 0],
            ['loket_id' => 29, 'tenant_id' => null, 'loket_nama' => 'Loket 29', 'loket_nomor' => '29', 'loket_aktif' => 0],
            ['loket_id' => 30, 'tenant_id' => null, 'loket_nama' => 'Loket 30', 'loket_nomor' => '30', 'loket_aktif' => 0],
        ];

        foreach ($dataLoket as $loket) {
            TenantLoket::updateOrCreate(['loket_id' => $loket['loket_id']], $loket);
        }

        $this->command->info('✅ Seed tenant_loket sukses: ' . count($dataLoket) . ' record berhasil diinsert');
    }
}
