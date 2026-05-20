<?php

use App\Models\Misc;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReportContactNumberToMisc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Misc::insert([
			['key' => 'report_contact_number', 'created_at' => now()]
		]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('misc', function (Blueprint $table) {
            //
        });
    }
}
