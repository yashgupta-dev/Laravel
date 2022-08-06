<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsDescriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('room_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('meta',70);
            $table->string('tag',170)->nullable();
            $table->string('keyword',170)->nullable();
            $table->float('price');
            $table->integer('quantity')->default(0);
            $table->string('room_prefix')->nullable();
            $table->string('booking_prefix')->nullable();
            $table->string('adult')->nullable();
            $table->string('child')->nullable();
            $table->string('booking_from');
            $table->string('booking_till');
            $table->string('image')->nullable();
            $table->longText('image_bulk')->nullable();
            $table->string('status');
            $table->string('slug')->unique();
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
        Schema::dropIfExists('rooms_descriptions');
    }
}
