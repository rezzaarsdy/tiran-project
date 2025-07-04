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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();

            $table->string('nama');
            $table->string('alamat')->nullable();
            $table->string('jabatan')->nullable();
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan', 'lainnya'])->default('lainnya');
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'hindu', 'buddha', 'konghucu', 'lainnya'])->default('lainnya');
            $table->string('avatar')->nullable();

            $table->date('tanggal_lahir')->nullable();
            $table->string('tempat_lahir')->nullable();

            $table->string('status_perkawinan')->nullable();

            $table->string('status')->default('aktif'); //status disini berisi aktif atau tidak aktif 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
