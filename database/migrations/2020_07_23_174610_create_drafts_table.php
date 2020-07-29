<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->datetime('registered_date');
            $table->string('explanation');
            $table->string('auth_1');
            $table->string('auth_2')->nullable();
            $table->string('auth_3')->nullable();
            $table->string('auth_4')->nullable();
            $table->string('auth_5')->nullable();
            $table->integer('process');
            $table->string('authorization')->default('yet');
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
        Schema::dropIfExists('drafts');
    }
}
