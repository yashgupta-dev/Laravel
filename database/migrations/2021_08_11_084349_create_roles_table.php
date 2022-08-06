<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->longText('permission');
            $table->timestamps();
        });
        DB::table('roles')->insert(['name'=>'Default','description'=>'This is User Group, User can perform some action like read and write.','permission'=>'{"access":["User\/HomeController","User\/ProfileController","User\/TicketController"],"modify":["User\/HomeController","User\/ProfileController"]}']);
        DB::table('roles')->insert(['name'=>'Administrator','description'=>'This is Administrator Group, Administrator can control everything','permission'=>'{"access":["Admin\/CategoryController","Admin\/HomeController","Admin\/ProfileController","Admin\/SettingController","Admin\/TicketController","Admin\/UsersController","Admin\/extension\/module\/Facebook","Admin\/extension\/module\/Google","User\/AccountController","User\/AddressController","User\/HomeController","User\/ProfileController","User\/TicketController"],"modify":["Admin\/CategoryController","Admin\/HomeController","Admin\/ProfileController","Admin\/SettingController","Admin\/TicketController","Admin\/UsersController","Admin\/extension\/module\/Facebook","Admin\/extension\/module\/Google","User\/AccountController","User\/AddressController","User\/HomeController","User\/ProfileController","User\/TicketController"]}']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
