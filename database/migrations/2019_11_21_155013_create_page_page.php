<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagePage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_page', function (Blueprint $table) {
            $table->unsignedBigInteger('page_id');
            $table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');

			$table->unsignedBigInteger('featured_page_id');
			$table->foreign('featured_page_id')->references('id')->on('pages')->onDelete('cascade')->onUpdate('cascade');

			$table->primary(['page_id', 'featured_page_id']);
			$table->unsignedBigInteger('position')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('page_page');
    }
}
