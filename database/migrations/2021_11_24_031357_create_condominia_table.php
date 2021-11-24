<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCondominiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('condominia', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_city')->nullable();
            $table->string('name', 200)->nullable(false);
            $table->string('address', 150)->nullable(false);
            $table->string('neighborhood', 200)->nullable(false);
            $table->timestamps();
            $table->foreign('id_city')->references('id')->on('cities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('condominia');
    }
}
