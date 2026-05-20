<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageSections extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->bigIncrements('id');

			$table->bigInteger('page_id')->unsigned()->nullable();
			$table->foreign('page_id')->references('id')->on('pages')->onUpdate('cascade')->onDelete('cascade');

			$table->string('type')->nullable()->index();
            $table->string('section_image')->nullable()->index();
            $table->text('content_1_en')->nullable();
            $table->text('content_1_hr')->nullable();
            $table->text('content_2_en')->nullable();
            $table->text('content_2_hr')->nullable();
            $table->unsignedBigInteger('position_in_page')->nullable()->index();
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
        Schema::dropIfExists('page_sections');
    }
}
