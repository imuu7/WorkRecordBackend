<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLineConfigsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('line_configs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('val');
            $table->string('nickname');
            $table->timestamps();
            $table->softDeletes();
        });

        // Insert some stuff
        DB::table('line_configs')->insert(
            array(
                'name' => 'Line',
                'val' => '123',
                'nickname' => 'LineToken'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('line_configs');
    }
}
