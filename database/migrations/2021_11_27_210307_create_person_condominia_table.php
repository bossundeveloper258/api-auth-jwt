<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonCondominiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_condominia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_condominia')->nullable();
            $table->unsignedBigInteger('id_person')->nullable();
            $table->boolean('status')->nullable(false);
            $table->timestamps();

            $table->foreign('id_condominia')->references('id')->on('condominia')
                ->onDelete('cascade');

            $table->foreign('id_person')->references('id')->on('people')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person_condominia');
    }
}
