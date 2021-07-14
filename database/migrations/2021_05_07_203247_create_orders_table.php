<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->double('cash_totol',15,2)->default(0)->comment('รวมราคาสินค้า');
            $table->double('cash',15,2)->default(0)->comment('เงินสด');
            $table->double('discount',15,2)->default(0)->comment('ส่วนลด');
            $table->double('net_amount',15,2)->default(0)->comment('ยอดสุทธิ');
            $table->double('change',15,2)->default(0)->comment('เงินทอน');
            $table->string('status')->default('รอชำระเงิน')->comment('สถานะ');
            $table->string('paid_by')->default('เงินสด')->comment('ชำระโดย');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->bigInteger('customer_id')->unsigned()->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branchs')->onDelete('cascade');
            
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
}
