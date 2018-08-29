<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbusinessAddressablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibusiness__addressables', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('address_id')->unsigned();
            $table->integer('ibusiness__addressables_id')->unsigned();
            $table->string('ibusiness__addressables_type');

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
        Schema::dropIfExists('ibusiness__addressables');
    }
}
