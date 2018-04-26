<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class IncomeAndExpenditure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('income_and_expenditure', function (Blueprint $table) {
            $table->increments('id')->comment('自增id');
            $table->string('item', 100)->default('')->comment('项目');
            $table->unsignedInteger('date')->default(0)->comment('时间');
            $table->decimal('amount')->default(0)->comment('金额');
            $table->string('remark')->default('')->comment('备注');
            $table->unsignedTinyInteger('type')->default(0)->comment('类型：1.收入 2.支出');
            $table->unsignedInteger('user_id')->default(0)->comment('用户id');
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
        Schema::dropIfExists('income_and_expenditure');
    }
}
