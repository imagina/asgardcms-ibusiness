<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIbusinessproductpricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ibusiness__productprices', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
          
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('icommerce__products')->onDelete('restrict');

            $table->integer('business_id')->unsigned();
            $table->foreign('business_id')->references('id')->on('ibusiness__userbusinesses')->onDelete('restrict');

            $table->double('price', 30, 2)->default(0);

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
        Schema::dropIfExists('ibusiness__productprices');
    }
}
