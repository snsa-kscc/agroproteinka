<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsItemImages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_item_images', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('news_item_id')->nullable()->index();
            $table->foreign('news_item_id')->references('id')->on('news_items')->onDelete('cascade')->onUpdate('cascade');

            $table->string('imagename')->nullable()->index();
            $table->string('position')->nullable()->index();
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
        Schema::dropIfExists('news_item_images');
    }
}
