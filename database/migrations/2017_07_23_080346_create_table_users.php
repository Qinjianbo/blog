<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id')->comment('用户自增id');
            $table->string('username', 20)->unique()->comment('用户名');
            $table->string('password')->comment('密码');
            $table->string('email')->unique()->nullable()->default('')->comment('电子邮箱');
            $table->string('phone')->unique()->nullable()->default(0)->comment('手机号码');
            $table->text('intro')->nullable()->comment('自我介绍');
            $table->string('avatar_url')->nullable()->default('')->comment('头像地址');
            $table->timestamps();
            $table->index(['username', 'password']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
