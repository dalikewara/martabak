<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('author');
            $table->string('title');
            $table->string('theme_name');
            $table->string('theme_status');
            $table->string('theme_version');
            $table->longtext('theme_description');
            $table->string('theme_category');
            $table->string('theme_price');
            $table->string('theme_url');
            $table->string('theme_date_release');
            $table->string('theme_pic');
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
        Schema::drop('themes');
    }
}
