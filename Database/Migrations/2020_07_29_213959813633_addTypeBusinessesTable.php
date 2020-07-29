<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeBusinessesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('ibusiness__businesses', function (Blueprint $table) {
        $table->integer('type_id')->unsigned()->nullable();
        $table->foreign('type_id')->references('id')->on('ibusiness__types');

    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('ibusiness__businesses', function (Blueprint $table) {
      $table->dropForeign('ibusiness__businesses_type_id_foreign');
      $table->dropColumn('type_id');
    });
  }
}
