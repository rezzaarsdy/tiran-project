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
        Schema::create('karyawan_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade');
            $table->string('motto')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            //banyak yg bisa di tambahkan. sesuai kebutuhan form
            
            $table->date('tanggal_masuk')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawan_details');
    }
};
