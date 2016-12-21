<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('email', 100);
            $table->string('password', 100);
            $table->string('device_id', 100)->default('');
            $table->string('nick_name', 100)->default('');
            $table->enum('sex', ['f', 'm', 'p'])->default('p');
            $table->tinyInteger('age', false, true)->default(0);
            $table->string('occupation', 100)->default('');
            $table->string('client_ip', 100)->default('');
            $table->string('cfg', 100)->default('');
            $table->rememberToken();
            $table->timestamps();
            $table->unique('email');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
