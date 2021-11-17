<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('fee_id')->nullable();
            $table->string('f_name');
            $table->unsignedBigInteger('collection_id')->nullable();
            $table->unsignedBigInteger('br_id')->nullable();
            $table->integer('seq_id')->nullable();
            $table->string('fee_type_ledger');
            $table->string('fee_headtype')->nullable();
            $table->foreign('br_id')->references('id')->on('branch')->onDelete('cascade');
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
        Schema::dropIfExists('fee_types');
    }
}
