<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinenotifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linenotifies', function (Blueprint $table) {
            $table->id();
            $table->string('token');
            $table->bigInteger('branch_id')->unsigned();
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
        Schema::dropIfExists('linenotifies');
    }
}
