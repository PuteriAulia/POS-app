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
        Schema::table('supliers', function (Blueprint $table) {
            $table->string('suplier_status', 10)->after('suplier_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supliers', function (Blueprint $table) {
            $table->dropColumn('suplier_status');
        });
    }
};
