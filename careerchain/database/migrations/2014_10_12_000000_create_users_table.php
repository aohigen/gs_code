<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('catchcopy')->nullable();
            $table->string('profile_img')->nullable();
            $table->string('main_img')->nullable();
            $table->date('birthday')->nullable();
            $table->string('website')->nullable();
            $table->string('birth_prefecture')->nullable();
            $table->string('nationality')->nullable();
            $table->string('work_company')->nullable();
            $table->string('work_industry')->nullable();
            $table->string('work_position')->nullable();
            $table->string('final_education')->nullable();
            $table->string('skill_set')->nullable();
            $table->string('challenge_skill')->nullable();
            $table->string('free_comment')->nullable();
            $table->integer('stake_capacity')->default(100);
            $table->integer('staked_capacity')->default(10);
            $table->integer('cc_token')->nullable();
            $table->string('token_address')->nullable();
            $table->integer('step_code')->default(0);
            $table->integer('admin_flg')->default(0);
            $table->integer('life_flg')->default(1);
            $table->string('account_type')->default('user');
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
        Schema::dropIfExists('users');
    }
}
