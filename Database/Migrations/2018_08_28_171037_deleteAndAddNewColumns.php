<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteAndAddNewColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('ibusiness__businesses', function (Blueprint $table) {
        $table->dropColumn(['address_1','city','postcode','country','zone']);
        $table->text('options')->nullable();
        $table->string('phone');
        $table->string('email');
        $table->string('nit');
        $table->string('person_firstname');
        $table->string('person_lastname');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
