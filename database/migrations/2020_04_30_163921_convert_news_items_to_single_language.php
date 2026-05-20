<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ConvertNewsItemsToSingleLanguage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('news_items', function (Blueprint $table) {
            $table->renameColumn('content_hr', 'content');
            $table->renameColumn('intro_hr', 'intro');
            $table->renameColumn('title_hr', 'title');

			$table->dropColumn('content_en');
			$table->dropColumn('intro_en');
			$table->dropColumn('title_en');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('news_items', function (Blueprint $table) {
            //
        });
    }
}
