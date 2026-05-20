<?php

namespace App\Http\View\Composers;

use App\Models\Misc;
use Illuminate\View\View;

class PageComposer
{
	public function compose(View $view)
	{
		$pageClass = config('lfb.pageClass');
		$navPages = $pageClass::navigationPages()->get();
		$formsPage = $pageClass::where('page_type', 'forms')->active()->first();
		$legalPages = $pageClass::legalPages()->get();
		$privacyPolicyPage = $legalPages->where('page_type', 'privacy')->first();
		$misc = Misc::localizedValues();

		$view->with(compact('navPages', 'formsPage', 'legalPages', 'privacyPolicyPage', 'misc'));
	}
}