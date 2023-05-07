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
        Schema::create('stock_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id');
            $table->unsignedBigInteger('from_branch')->references('id')->on('branches')->default(0);
            $table->unsignedBigInteger('to_branch')->references('id')->on('branches');
            $table->string('transfer_type', 15)->comment('purchase/transfer')->nullable();
            $table->unsignedBigInteger('product_id')->references('id')->on('products');
            $table->integer('qty')->default(0);
            $table->foreign('transfer_id')->references('id')->on('stock_transfers')->onDelete('cascade');
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
        Schema::dropIfExists('stock_transfer_details');
    }
};
