<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('setting_id');
            $table->string('code',128);
            $table->string('key',128);
            $table->string('value');
            $table->tinyInteger('serialized')->default('0');
            $table->timestamps();
        });
        DB::table('settings')->insert(['code'=>'config','key'=>'config_user_account_login','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_default_redirect','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_password_forget','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_account_create','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_ticket_support_panel','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_other_devices','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_two_way_authentication','value'=>'0']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_password_edit','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_profile_edit','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_max_upload_size','value'=>'30000']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_mime_type','value'=>'["jpg","jpeg","png","xml","sql"]']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_default_group','value'=>'1']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_pagination','value'=>'10']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_loder_name','value'=>' L_O_G_O']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_loder_type','value'=>'text']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_store_name','value'=>'Logo']);
        DB::table('settings')->insert(['code'=>'config','key'=>'config_site_url','value'=>'https://example.com']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
