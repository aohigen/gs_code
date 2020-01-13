<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('blockchain_id');
            $table->integer('created_user_id');
            $table->string('project_name');
            $table->string('project_detail');
            $table->string('project_goal')->nullable();
            $table->string('before_comment')->nullable();
            $table->string('addtional_comment')->nullable();
            $table->string('project_result')->nullable();
            $table->date('limit_date')->nullable();
            $table->string('tags')->nullable();
            $table->integer('cheer')->default(0);
            $table->integer('status')->default(1);
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
        Schema::dropIfExists('projects');
    }
}
