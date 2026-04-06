<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

class TenantSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tenants')->truncate();

        $data = [
            ['tenant_id' => 1, 'tenant_nama' => 'Dinas Penanaman Modal dan PTSP', 'tenant_urusan' => 'Informasi', 'tenant_prefix' => 'A', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 2, 'tenant_nama' => 'Dinas Penanaman Modal dan PTSP', 'tenant_urusan' => 'IMB', 'tenant_prefix' => 'B', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 3, 'tenant_nama' => 'Dinas Penanaman Modal dan PTSP', 'tenant_urusan' => 'Pengaduan dan Konsultasi', 'tenant_prefix' => 'C', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 4, 'tenant_nama' => 'Dinas Penanaman Modal dan PTSP', 'tenant_urusan' => 'Helpdesk Perijinan', 'tenant_prefix' => 'D', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 5, 'tenant_nama' => 'Dinas Penanaman Modal dan PTSP', 'tenant_urusan' => 'Pelayanan Mandiri', 'tenant_prefix' => 'F', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 6, 'tenant_nama' => 'Dinas Lingkungan Hidup', 'tenant_urusan' => null, 'tenant_prefix' => 'G', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 7, 'tenant_nama' => 'Pengadilan Negeri', 'tenant_urusan' => null, 'tenant_prefix' => 'H', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 8, 'tenant_nama' => 'Kementerian Agama', 'tenant_urusan' => null, 'tenant_prefix' => 'I', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 9, 'tenant_nama' => 'Dinas Perhubungan', 'tenant_urusan' => null, 'tenant_prefix' => 'J', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 10, 'tenant_nama' => 'BPJS Ketenagakerjaan', 'tenant_urusan' => null, 'tenant_prefix' => 'K', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 11, 'tenant_nama' => 'Kantor Pertanahan', 'tenant_urusan' => null, 'tenant_prefix' => 'L', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 12, 'tenant_nama' => 'Kejaksaan Negeri', 'tenant_urusan' => null, 'tenant_prefix' => 'M', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 13, 'tenant_nama' => 'Dinas Kesehatan', 'tenant_urusan' => null, 'tenant_prefix' => 'N', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 14, 'tenant_nama' => 'Polres', 'tenant_urusan' => null, 'tenant_prefix' => 'O', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 15, 'tenant_nama' => 'Samsat', 'tenant_urusan' => null, 'tenant_prefix' => 'P', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 16, 'tenant_nama' => 'Kodim', 'tenant_urusan' => null, 'tenant_prefix' => 'Q', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 17, 'tenant_nama' => 'Kantor Pajak Pratama', 'tenant_urusan' => null, 'tenant_prefix' => 'R', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 18, 'tenant_nama' => 'Badan Pengelolaan Keuangan dan Pendapatan Daerah', 'tenant_urusan' => null, 'tenant_prefix' => 'S', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 19, 'tenant_nama' => 'Dinas Perumahan dan Kawasan Permukiman', 'tenant_urusan' => null, 'tenant_prefix' => 'T', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 20, 'tenant_nama' => 'Dinas Pekerjaan Umum dan Penataan Ruang', 'tenant_urusan' => null, 'tenant_prefix' => 'U', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 21, 'tenant_nama' => 'Dinas Perindustrian dan Ketenagakerjaan', 'tenant_urusan' => null, 'tenant_prefix' => 'V', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 22, 'tenant_nama' => 'Dinas Kependudukan dan Pencatatan Sipil', 'tenant_urusan' => null, 'tenant_prefix' => 'W', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 23, 'tenant_nama' => 'Bank Jateng', 'tenant_urusan' => null, 'tenant_prefix' => 'BJ', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
            ['tenant_id' => 24, 'tenant_nama' => 'Pengadilan Agama', 'tenant_urusan' => null, 'tenant_prefix' => 'PA', 'tenant_aktif' => 1, 'tenant_image' => null, 'tenant_keterangan' => null],
        ];

        Tenant::insert($data);
        $this->command->info('✅ '.count($data).' data tenant berhasil dimasukkan!');
    }
}
