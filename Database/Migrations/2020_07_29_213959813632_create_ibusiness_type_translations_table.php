<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbusinessTypeTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibusiness__type_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('type_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['type_id', 'locale']);
            $table->foreign('type_id')->references('id')->on('ibusiness__types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ibusiness__type_translations', function (Blueprint $table) {
            $table->dropForeign(['type_id']);
        });
        Schema::dropIfExists('ibusiness__type_translations');
    }
}
