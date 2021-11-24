<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_properties', function (Blueprint $table) {
            $table->id();
            $table->string('name' , 200)->nullable(false);
            $table->boolean('status')->nullable(false);
            $table->timestamps();
        });

        Schema::table('condominia', function (Blueprint $table) {
            $table->unsignedBigInteger('id_type_property')->after('neighborhood')->nullable();
            $table->foreign('id_type_property')->references('id')->on('type_properties');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('type_properties');
    }
}
