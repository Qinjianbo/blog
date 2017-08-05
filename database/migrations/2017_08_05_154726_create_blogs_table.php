<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->increments('id')->comment('博客自增编号id');
            $table->unsignedInteger('user_id')->comment('用户id');
            $table->text('content')->comment('博客的内容');
            $table->string('title')->comment('博客的标题');
            $table->string('description')->comment('博客的简介');
            $table->unsignedTinyInteger('type')->default(1)->comment('1:原创 2:翻译');
            $table->unsignedInteger('reading')->default(0)->comment('该篇博客的阅读量');
            $table->unsignedInteger('comment_num')->default(0)->comment('该篇博客的评论量');
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
        Schema::dropIfExists('blogs');
    }
}
