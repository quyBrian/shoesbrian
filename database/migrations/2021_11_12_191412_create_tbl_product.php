<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->increments('id_product');
            $table->integer('id_category_product');
            $table->integer('id_brand');
            $table->string('name_product');
            $table->text('desc_product');
            $table->text('content_product');
            $table->string('price_product');
            $table->string('image_product');
            $table->string('size_product');
            $table->string('color_product');
            $table->integer('status_product');
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
        Schema::dropIfExists('tbl_product');
    }
}
