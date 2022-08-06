<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatusmanagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statusmanages', function (Blueprint $table) {
            $table->id();
            $table->string('status_name');
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
        DB::table('statusmanages')->insert(['status_name'=>'Open','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Closed','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Pending','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Answered','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Resolved','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'UnAssigned','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Starred','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Trashed','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'New','status'=>'1']);
        DB::table('statusmanages')->insert(['status_name'=>'Span','status'=>'1']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('statusmanages');
    }
}
