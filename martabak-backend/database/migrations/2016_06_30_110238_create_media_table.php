<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->string('file_name');
            $table->string('file_type');
            $table->string('tmp_name');
            $table->integer('error');
            $table->integer('size');
            $table->string('meta_1');
            $table->string('meta_2');
            $table->string('meta_3');
            $table->string('meta_4');
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
        Schema::drop('media');
    }
}
