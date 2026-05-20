<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Misc;

class AddSocialMediaLinksToMisc extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Misc::insert([
			['key' => 'twitter_link', 'created_at' => now()],
			['key' => 'linked_in_link', 'created_at' => now()],
			['key' => 'google_link', 'created_at' => now()],
			['key' => 'facebook_link', 'created_at' => now()]
		]);
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
