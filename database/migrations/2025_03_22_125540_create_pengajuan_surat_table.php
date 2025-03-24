<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->string('nrp', 7);
            $table->enum('jenis_surat', ['Surat Keterangan Aktif', 'Surat Cuti', 'Surat Mata Kuliah']);
            $table->text('deskripsi');
            $table->enum('status', ['Diajukan', 'Disetujui', 'Ditolak'])->default('Diajukan');
            $table->string('file_surat')->nullable();
            $table->timestamps();
    
            $table->foreign('nrp')->references('nrp')->on('mahasiswa')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
