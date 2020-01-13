<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MarketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('markets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('item_type');
            $table->string('item_name');
            $table->string('item_copy');
            $table->integer('price');
            $table->string('item_detail');
            $table->string('sell_scope');//どの範囲のユーザーに販売をするのか（ステークスのみか、全員か）
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
        //
    }
}
