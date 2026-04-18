<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('issuer');          // Pihak yang mengeluarkan (Google, Dicoding, dll)
            $table->string('year', 10);        // Tahun terbit
            $table->string('image')->nullable();  // Foto sertifikat
            $table->string('link')->nullable();   // Link verifikasi
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
