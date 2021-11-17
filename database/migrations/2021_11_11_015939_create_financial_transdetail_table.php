<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialTransdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('financial_transdetail', function (Blueprint $table) {
            $table->id();
            $table->integer('financialtran_id');
            $table->integer('module_id')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('head_id')->nullable();
            $table->tinyInteger('crdr')->nullable();
            $table->integer('br_id')->nullable();
            $table->string('head_name')->nullable();
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
        Schema::dropIfExists('financial_transdetail');
    }
}
