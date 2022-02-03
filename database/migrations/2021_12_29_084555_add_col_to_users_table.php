<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('nick')->nullable()->comment('暱稱');
            $table->string('bank_name')->nullable()->comment('銀行名稱');
            $table->string('bank_code')->nullable()->comment('銀行代號');
            $table->string('bank_number')->nullable()->comment('分行代號');
            $table->string('bank_account')->nullable()->comment('銀行帳號');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('nick');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_code');
            $table->dropColumn('bank_number');
            $table->dropColumn('bank_account');
        });
    }
}
