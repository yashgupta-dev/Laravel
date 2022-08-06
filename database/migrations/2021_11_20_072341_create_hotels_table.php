<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('hotel_name',180);
            $table->string('hotel_short_desc',220);
            $table->longText('hotel_desc');
            $table->string('hotel_meta',120);
            $table->string('hotel_meta_tag',170)->nullable();
            $table->string('hotel_keywords',180)->nullable();
            $table->string('hotel_address');
            $table->string('hotel_website',180)->nullable();
            $table->string('hotel_email')->unique();
            $table->string('hotel_phone',20)->unique();
            $table->string('hotel_fax',20)->unique()->nullable();
            $table->string('image')->nullable();
            $table->longText('gallery')->nullable();
            $table->string('checkin',20);
            $table->string('checkout',20);
            $table->string('latitude',100);
            $table->string('longitude',100);
            $table->bigInteger('country');
            $table->bigInteger('city');
            $table->boolean('status')->default(0);
            $table->string('slug')->unique();
            $table->longtext('custom_fields')->nullable();            
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
        Schema::dropIfExists('hotels');
    }
}
