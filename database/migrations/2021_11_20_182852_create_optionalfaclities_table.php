<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionalfaclitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('optionalfaclities', function (Blueprint $table) {
            $table->id();
            $table->string('optional_facilitie_name');
            $table->string('optional_facilitie_icon')->nullable();
            $table->string('optional_facilitie_sort')->default(0);
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
        Schema::dropIfExists('optionalfaclities');
    }
}
