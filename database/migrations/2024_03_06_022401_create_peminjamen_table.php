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
        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 50);
            $table->string('penulis', 30);
            $table->string('penerbit', 30);
            $table->year('tahun');
            $table->enum('kategori', ['fiksi', 'non fiksi', 'komik']);
            $table->string('dstock', 3);
            $table->text('image');  
            $table->timestamps();
        });

        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table->string('id_user')->constrained('users');
            $table->string('id_buku')->constrained('buku');
            $table->date('tglPinjam');
            $table->date('tglKembali');
            $table->enum('status', ['dipinjam', 'dikembalikan']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bukus');
        Schema::dropIfExists('peminjamen');
    }
};
