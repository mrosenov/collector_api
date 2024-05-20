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
        Schema::create('invoice_products', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->integerIncrements('id');
            $table->unsignedInteger('invoice_id')->index();
            $table->unsignedInteger('product_id')->index();
            $table->integer('quantity');
            $table->integer('price')->default(0);
            $table->decimal('tax_rate', 5,2)->default(0.00);
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_products');
    }
};
