<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('slug')->nullable();
            $table->string('sku', 128)->nullable();
            $table->string('des')->default('null')->nullable();
            $table->string('unit')->nullable();
            $table->double('retail_price',15,2)->default(0)->comment('ราคาปลีก'); // ราคาส่ง
            $table->double('wholesale_price',15,2)->default(0)->comment('ราคาส่ง'); // ราคาปลีก
            $table->integer('wholesaler')->default(5)->comment('จำนวนค้าส่ง'); // ราคาปลีก
            $table->double('sale_price',15,2)->default(0); // ราคาลดราคา
            // $table->double('price',15,2)->default(0);
            $table->unsignedInteger('qty')->default(0); // quantity
            $table->boolean('featured')->default(false);
            // $table->boolean('retail')->default(true);  // ขายปลีก
            $table->string('image')->default('images/products/default.png');
            $table->bigInteger('catagory_id')->unsigned()->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('catagory_id')->references('id')->on('catagories')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}

