<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateHelloTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hello', function (Blueprint $table) {
            // カラム名変更
            $table->renameColumn('str_2', 'str_opt');

            // 新しくカラム追加(null許容)
            $table->integer('count')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hello', function (Blueprint $table) {
            //
        });
    }
}
