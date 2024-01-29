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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('invoice')->nullable();
            $table->foreignId('user_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
            $table->foreignId('book_id')->cascadeOnDelete()->cascadeOnUpdate()->constrained();
            $table->integer('qty');
            $table->string('nama_pembeli')->nullable();
            $table->enum('status',['Dibayar', 'Pending']);
            $table->integer('total_semua')->nullable();
            $table->integer('uang_bayar')->nullable();
            $table->integer('uang_kembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
