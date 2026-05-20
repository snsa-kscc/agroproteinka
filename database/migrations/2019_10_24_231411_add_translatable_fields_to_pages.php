<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTranslatableFieldsToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->renameColumn('name', 'name_hr');
            $table->renameColumn('slug', 'slug_hr');
            $table->renameColumn('title', 'title_hr');
            $table->renameColumn('lead', 'lead_hr');
            $table->renameColumn('content', 'content_hr');
            $table->renameColumn('meta_keywords', 'meta_keywords_hr');
            $table->renameColumn('meta_description', 'meta_description_hr');

			$table->string('name_en')->index()->nullable();
			$table->string('slug_en')->index()->nullable();
			$table->string('title_en')->index()->nullable();
			$table->text('lead_en')->nullable();
			$table->text('content_en')->nullable();
			$table->text('meta_keywords_en')->nullable();
			$table->text('meta_description_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pages', function (Blueprint $table) {
            //
        });
    }
}
