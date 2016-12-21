<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('account', 100);
            $table->string('email', 100)->default('');
            $table->string('password', 100);
            $table->string('real_name', 100)->default('');
            $table->string('client_ip', 100)->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->unique('account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admins');
    }
}
