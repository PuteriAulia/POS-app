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
        Schema::create('products_out', function (Blueprint $table) {
            $table->id();
            $table->string('productOut_code',10);
            $table->integer('productOut_qty');
            $table->date('productOut_date');
            $table->text('productOut_info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_out');
    }
};
