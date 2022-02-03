<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClockinTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clockin', function (Blueprint $table) {
            $table->id();
            $table->string('date')->comment('日期');
            $table->string('type')->comment('打卡類別');
            $table->string('name')->comment('姓名');
            $table->integer('user_id')->comment('用戶ID');
            $table->timestamp('start_time')->nullable()->comment('上班時間');
            $table->timestamp('end_time')->nullable()->comment('下班時間');
            $table->string('over_time')->nullable()->comment('加班');
            $table->string('late_time')->nullable()->comment('遲到');
            $table->string('leave_early_time')->nullable()->comment('早退');
            $table->string('total')->nullable()->comment('總計時數');
            $table->string('verify')->default('未審核')->comment('審核');
            $table->text('note')->nullable()->comment('備註');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clockin');
    }
}
