<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TelMsgLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tel_msg_log', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->index();
            $table->integer('msg_from_id');
            $table->text('msg_from_body');
            $table->datetime('message_date');
            $table->text('chat_body')->nullable();
            $table->text('chat_text')->nullable();
            $table->timestamps();
            $table->SoftDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tel_msg_log');
    }
}