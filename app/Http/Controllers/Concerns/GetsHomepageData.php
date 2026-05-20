<?php

namespace App\Http\Controllers\Concerns;

use App\Models\NewsItem;
use App\Services\FeaturedSectionHelper;

trait GetsHomepageData
{
	protected function getHomepageData($pageClass, $initialNewsItem = null)
	{
		$page = $pageClass::where('depth', 0)->with('featuredPages')->active()->first();
		$newsItems = NewsItem::published()
			->with('orderedImages')
			->orderBy('published_at', 'desc')
			->get();

		$data = [
			'page' => $page,
			'newsItems' => $newsItems,
			'initialNewsItem' => $initialNewsItem,
			'sectionHelper' => new FeaturedSectionHelper()
		];

		return [$page, $data];
    }
}