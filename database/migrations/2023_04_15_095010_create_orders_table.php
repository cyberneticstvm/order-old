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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 15)->unique();            
            $table->unsignedBigInteger('medical_record_id')->default(0);            
            $table->unsignedBigInteger('doctor_id')->default(0);
            $table->unsignedBigInteger('branch_id')->references('id')->on('branches');
            $table->unsignedBigInteger('patient_id')->default(0);
            $table->string('patient_name', 50)->nullable();
            $table->smallInteger('age')->default(0);
            $table->string('gender', 15)->nullable();
            $table->text('address')->nullable();
            $table->string('mobile', 10)->nullable();
            $table->dateTime('order_date')->nullable();
            $table->date('expected_delivery_date')->nullable();
            $table->unsignedBigInteger('product_advisor')->references('id')->on('users');
            $table->decimal('order_total', 7, 2)->default(0.00);
            $table->decimal('discount', 7, 2)->default(0.00)->nullable();
            $table->decimal('total_after_discount', 7, 2)->default(0.00);
            $table->decimal('advance', 7, 2)->default(0.00)->nullable();
            $table->decimal('balance', 7, 2)->default(0.00)->nullable();
            $table->dateTime('advance_received_at')->nullable();
            $table->dateTime('balance_received_at')->nullable();
            $table->unsignedBigInteger('advance_payment_type')->references('id')->on('payment_modes')->default(0)->nullable();
            $table->unsignedBigInteger('balance_payment_type')->references('id')->on('payment_modes')->default(0)->nullable();
            $table->unsignedBigInteger('order_status')->references('id')->on('order_statuses');
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('orders');
    }
};
