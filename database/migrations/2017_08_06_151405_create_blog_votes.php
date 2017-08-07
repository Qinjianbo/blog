<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogVotes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_votes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('点赞人id');
            $table->unsignedInteger('blog_id')->comment('被点赞博客id');
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
        Schema::dropIfExists('blog_votes');
    }
}
