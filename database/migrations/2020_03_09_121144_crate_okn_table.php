<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateOknTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('okn', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('name_chr')->nullable();
            $table->biginteger('complex_id')->nullable();
            $table->string('date_okn')->nullable();
            $table->bigInteger('district_id')->nullable();
            $table->text('address')->nullable();
            $table->text('act')->nullable();
            $table->string('category')->nullable();
            $table->string('owner')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->double('sum_npd', 8, 2)->nullable();
            $table->dateTime('start_job')->nullable();
            $table->dateTime('end_job')->nullable();
            $table->text('finance')->nullable();
            $table->text('npd')->nullable();
            $table->string('state')->nullable();
            $table->string('status')->nullable();
            $table->text('comment')->nullable();
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
        Schema::dropIfExists('okn');
    }
}
