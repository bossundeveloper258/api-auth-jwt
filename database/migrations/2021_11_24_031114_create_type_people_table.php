<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_people', function (Blueprint $table) {
            $table->id();
            $table->string('description' , 250)->nullable(false);
            $table->boolean('status')->nullable(false);
            $table->timestamps();
        });

        Schema::table('people', function (Blueprint $table) {
            $table->unsignedBigInteger('id_type_person')->after('status')->nullable();
            $table->foreign('id_type_person')->references('id')->on('type_people');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_people');
    }
}
