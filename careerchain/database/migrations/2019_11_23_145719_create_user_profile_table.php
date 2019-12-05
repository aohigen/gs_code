<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->unique();
            $table->string('nick_name');
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
            $table->integer('vote_token')->default(100);
            $table->integer('vote_capacity')->default(100);
            $table->integer('cc_token')->default(10000);
            $table->integer('offer_times')->default(0);
            $table->integer('offered_times')->default(0);
            $table->integer('admin_flg')->default(0);
            $table->integer('life_flg')->default(1);
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
        Schema::dropIfExists('user_profiles');
    }
}
