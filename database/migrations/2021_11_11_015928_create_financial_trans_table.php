<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_trans', function (Blueprint $table) {
            $table->id();
            $table->integer('module_id');
            $table->integer('tran_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('tranDate')->nullable();
            $table->string('acadYear')->nullable();
            $table->string('entrymode')->nullable();
            $table->string('Voucherno')->nullable();
            $table->integer('br_id')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('scholarship')->nullable();
            $table->string('duerev')->nullable();
            $table->string('scholarship_rev')->nullable();
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
        Schema::dropIfExists('financial_trans');
    }
}
