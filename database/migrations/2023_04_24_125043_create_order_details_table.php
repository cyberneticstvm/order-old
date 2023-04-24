<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('branch_id')->references('id')->on('branches');
            $table->string('product_type', 25)->nullable();
            $table->string('sph', 7)->nullable();
            $table->string('cyl', 7)->nullable();
            $table->string('axis', 7)->nullable();
            $table->string('addition', 7)->nullable();
            $table->unsignedBigInteger('product_id')->references('id')->on('products');
            $table->integer('qty')->default(0);
            $table->decimal('price', 7, 2)->default(0)->nullable();
            $table->decimal('tax_percentage', 5, 2)->default(0)->nullable();
            $table->decimal('tax_amount', 7, 2)->default(0)->nullable();
            $table->decimal('discount_percentage', 5, 2)->default(0)->nullable();
            $table->decimal('discount_amount', 7, 2)->default(0)->nullable();
            $table->decimal('total', 7, 2)->default(0)->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
