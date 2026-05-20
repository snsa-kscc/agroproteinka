<?php

use App\Models\Misc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMiscEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Misc::insert([
        	['key' => 'gdpr_notice_hr', 'created_at' => now()],
        	['key' => 'gdpr_notice_en', 'created_at' => now()],
        	['key' => 'cookie_notice_hr', 'created_at' => now()],
        	['key' => 'cookie_notice_en', 'created_at' => now()],
        	['key' => 'report_contact_hr', 'created_at' => now()],
        	['key' => 'report_contact_en', 'created_at' => now()],
        	['key' => 'menu_info_left_hr', 'created_at' => now()],
        	['key' => 'menu_info_left_en', 'created_at' => now()],
        	['key' => 'menu_info_right_hr', 'created_at' => now()],
        	['key' => 'menu_info_right_en', 'created_at' => now()]
		]);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 * @throws Exception
	 */
    public function down()
    {
        Misc::query()->delete();
    }
}
