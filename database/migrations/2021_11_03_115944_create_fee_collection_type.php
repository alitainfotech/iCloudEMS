<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeCollectionType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_collection_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('collectionhead');
            $table->string('collectionDescription');
            $table->unsignedBigInteger('br_id')->nullable();
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
        Schema::dropIfExists('fee_collection_type');
    }
}
