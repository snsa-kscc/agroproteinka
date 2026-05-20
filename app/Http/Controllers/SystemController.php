<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SystemController extends Controller
{
	public function linkStorage()
	{
		\Artisan::call('storage:link');

		return "Success!";
    }
}
