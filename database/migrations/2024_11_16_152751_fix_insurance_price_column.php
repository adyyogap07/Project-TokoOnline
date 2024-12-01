<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Ubah kolom inscurence_price yang ada
            $table->decimal('inscurence_price', 10, 2)->default(0)->change();
            
            // Atau jika kolom belum ada, tambahkan kolom baru
            // $table->decimal('inscurence_price', 10, 2)->default(0);
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Kembalikan ke kondisi semula tanpa default value
            $table->decimal('inscurence_price', 10, 2)->change();
        });
    }
};