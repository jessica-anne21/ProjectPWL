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
    Schema::create('kaprodi', function (Blueprint $table) {
        $table->string('id_kaprodi', 7)->primary();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        $table->foreignId('program_studi_id')->constrained('prodi')->onDelete('cascade');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kaprodi');
    }
};
