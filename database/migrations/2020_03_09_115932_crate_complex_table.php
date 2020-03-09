<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CrateComplexTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complex', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('name_chr')->nullable;
            $table->string('date_okn')->nullable;
            $table->text('address')->nullable;
            $table->text('act')->nullable;
            $table->string('category')->nullable;
            $table->string('owner')->nullable;
            $table->string('latitude')->nullable;
            $table->string('longitude')->nullable;
            $table->string('state')->nullable;
            $table->string('status')->nullable;
            $table->text('comment')->nullable;
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
        Schema::dropIfExists('complex');
    }
}
