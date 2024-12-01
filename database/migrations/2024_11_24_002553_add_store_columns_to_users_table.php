<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStoreColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'store_name')) {
                $table->string('store_name')->nullable();
            }
            if (!Schema::hasColumn('users', 'store_status')) {
                $table->boolean('store_status')->default(false);
            }
            // Tidak perlu menambahkan categories_id karena sudah ada
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['store_name', 'store_status']);
        });
    }
}