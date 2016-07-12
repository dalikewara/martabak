<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrashesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trashes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->longtext('meta_1');
            $table->longtext('meta_2');
            $table->longtext('meta_3');
            $table->longtext('meta_4');
            $table->longtext('meta_5');
            $table->longtext('meta_6');
            $table->longtext('meta_7');
            $table->longtext('meta_8');
            $table->longtext('meta_9');
            $table->longtext('meta_10');
            $table->longtext('meta_11');
            $table->longtext('meta_12');
            $table->longtext('meta_13');
            $table->longtext('meta_14');
            $table->longtext('meta_15');
            $table->longtext('meta_16');
            $table->longtext('meta_17');
            $table->longtext('meta_18');
            $table->longtext('meta_19');
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
        Schema::drop('trashes');
    }
}
