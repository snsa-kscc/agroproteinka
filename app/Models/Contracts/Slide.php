<?php

namespace App\Models\Contracts;

interface Slide
{
	public function title();
	public function imageUrl();
	public function trans($property, $locale = null);
}