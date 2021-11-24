<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('nuip', 15)->nullable(false);
            $table->string('name' , 250)->nullable(false);
            $table->string('lastname' , 250)->nullable(false);
            $table->string('email' , 250)->nullable(false);
            $table->string('phone' , 250)->nullable(false);
            $table->boolean('status')->nullable(false);
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_person')->after('password')->nullable();
            $table->foreign('id_person')->references('id')->on('people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
