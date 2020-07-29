<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbusinessBusinessTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibusiness__business_translations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            // Your translatable fields
            $table->string('name');
            $table->string('description');
            $table->integer('business_id')->unsigned();
            $table->string('locale')->index();
            $table->unique(['business_id', 'locale']);
            $table->foreign('business_id')->references('id')->on('ibusiness__businesses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ibusiness__business_translations', function (Blueprint $table) {
            $table->dropForeign(['business_id']);
        });
        Schema::dropIfExists('ibusiness__business_translations');
    }
}
