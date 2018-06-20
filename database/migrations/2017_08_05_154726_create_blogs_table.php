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
            $table->unsignedInteger('user_id')->default(0)->comment('用户id');
            $table->text('content')->comment('博客的内容');
            $table->unsignedTinyInteger('is_markdown')->default(1)->comment('博文是否为markdown语法编写');
            $table->string('title')->default('')->comment('博客的标题');
            $table->string('description')->default('')->comment('博客的简介');
            $table->unsignedTinyInteger('type')->default(1)->comment('1:原创 2:翻译');
            $table->unsignedInteger('reading')->default(0)->comment('该篇博客的阅读量');
            $table->unsignedInteger('comment_num')->default(0)->comment('该篇博客的评论量');
            $table->unsignedInteger('vote_num')->default(0)->comment('该篇博客被点赞量');
            $table->string('tags')->default('')->comment('标签 多个标签用英文逗号分割');
            $table->timestamps();
            $table->index('created_at');
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
