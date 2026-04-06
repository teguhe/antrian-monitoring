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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id('tenant_id');
            $table->string('tenant_nama');
            $table->text('tenant_urusan')->nullable();
            $table->string('tenant_prefix', 5)->unique();
            $table->boolean('tenant_aktif')->default(1);
            $table->string('tenant_image')->nullable();
            $table->text('tenant_keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
