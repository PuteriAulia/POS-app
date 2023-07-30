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
        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->string('transaction_code',50)->after('product_id');
            $table->foreign('transaction_code')->references('transaction_code')->on('transaction')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transaction_detail', function (Blueprint $table) {
            $table->dropForeign(['transaction_code']);
            $table->dropColumn('transaction_code');
        });
    }
};
