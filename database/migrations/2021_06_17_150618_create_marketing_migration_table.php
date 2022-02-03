<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMarketingMigrationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('marketing_migration', function (Blueprint $table) {
            $table->id();
            $table->string('tableName')->comment('表名稱');
            $table->string('rowName')->comment('欄位名稱');
            $table->string('rowType')->comment('欄位屬性');
            $table->string('strLimit')->nullable()->comment('字數限制');
            $table->string('note')->nullable()->comment('欄位備註');
            $table->boolean('nullableCol')->comment('允許null');
            $table->boolean('uniqueCol')->comment('是否唯一');
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
        Schema::dropIfExists('marketing_migration');
    }
}
