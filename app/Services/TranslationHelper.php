<?php

namespace App\Services;

class TranslationHelper
{
	public function localePrefix($locale)
	{
		$defaultLocale = config('gtcms.settings.entityLocales')[0];

		return ($locale == $defaultLocale) ? '/' : '/' . $locale . '/';
    }

	public function oppositeLocale()
	{
		return app()->getLocale() == 'hr' ? 'en' : 'hr';
	}
}