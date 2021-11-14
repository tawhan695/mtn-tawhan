<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefectivesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('defectives', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('qty')->default(0); // quantity
            $table->bigInteger('product_id')->unsigned()->nullable();
            $table->string('status')->nullable();
            $table->bigInteger('branch_id')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('branch_id')->references('id')->on('branchs')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('defectives');
    }
}
