<?php

use App\Models\Misc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeMenuToFooterInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Misc::where('key', 'menu_info_left_hr')->update(['key' => 'footer_info_left_hr']);
		Misc::where('key', 'menu_info_right_hr')->update(['key' => 'footer_info_right_hr']);
		Misc::where('key', 'menu_info_left_en')->update(['key' => 'footer_info_left_en']);
		Misc::where('key', 'menu_info_right_en')->update(['key' => 'footer_info_right_en']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
