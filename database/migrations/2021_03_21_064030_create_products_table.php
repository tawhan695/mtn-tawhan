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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('des')->default('');
            $table->string('unit')->nullable();
            $table->double('legular_price',15,2)->default(0); // ราคาต้นทุน
            $table->double('sale_price',15,2)->default(0); // ราคาขาย
            // $table->double('price',15,2)->default(0);
            $table->unsignedInteger('qty')->default(0); // quantity
            $table->boolean('featured')->default(false); 
            $table->boolean('retail')->default(true);  // ขายปลีก
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
