<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 200)->nullable(false);
            $table->boolean('status')->nullable(false);
            $table->timestamps();
        });

        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('id_city')->after('status');
            $table->foreign('id_city')->references('id')->on('type_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
