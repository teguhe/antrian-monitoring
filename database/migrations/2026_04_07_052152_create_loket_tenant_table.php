<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('loket_tenant', function (Blueprint $table) {
            $table->unsignedSmallInteger('loket_id')->primary();
            $table->unsignedInteger('tenant_id')->nullable()->index();
            $table->timestamps();
            // $table->foreign('tenant_id')->references('id')->on('tenants')->nullOnDelete();
        });
        // Seed data sesuai list yang diberikan
        $data = [
            [1,1], [2,2], [3,3], [4,4], [5,5], [6,5], [7,6], [8,7], [9,8], [10,9],
            [11,10], [12,11], [13,12], [14,13], [15,14], [16,15], [17,16], [18,17], [19,18], [20,19],
            [21,20], [22,21], [23,22], [24,23], [25,24], [26,null], [27,null], [28,null], [29,null], [30,null]
        ];
        foreach ($data as [$loket_id, $tenant_id]) {
            \DB::table('loket_tenant')->insert(compact('loket_id', 'tenant_id'));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loket_tenant');
    }
};
