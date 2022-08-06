<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addres', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('address_1');
            $table->string('address_2')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('postal');
            $table->string('land_mark')->nullable();
            $table->boolean('default')->default(0);
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
        Schema::dropIfExists('addres');
    }
}
