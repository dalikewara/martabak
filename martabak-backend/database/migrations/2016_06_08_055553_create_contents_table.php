<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('show_post');
            $table->integer('posts_per_page');
            $table->string('show_article_as');
            $table->integer('show_tag');
            $table->integer('show_category');
            $table->integer('show_media');
            $table->string('default_post_category');
            $table->integer('allow_post_comment');
            $table->integer('allow_page_comment');
            $table->integer('comment_configuration');
            $table->longtext('comment_moderation');
            $table->longtext('comment_blacklist');
            $table->integer('display_picture_for_commenters');
            $table->string('default_commenters_picture');
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
        Schema::drop('contents');
    }
}
