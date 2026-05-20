<?php

namespace App\Models\Concerns;

trait Translatable
{
	public function trans($property, $locale = null)
	{
		$localizedProperty = $property . '_' . ($locale ?: app()->getLocale());

		return $this->{$localizedProperty};
	}
}