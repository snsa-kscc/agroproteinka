<?php

namespace App\Models\GTCMS\Entities;

use App\Models\NewsItem as NewsItemModel;
use GTCrais\GTCMS\Resources\Concerns\SetsSlug;
use GTCrais\GTCMS\Resources\Entity;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsItem extends NewsItemModel
{
    use Entity, SetsSlug;

	public function images()
	{
		return $this->hasMany(NewsItemImage::class);
	}

	public static function editWith()
	{
		return ['orderedImages'];
	}

	public function getExcerptAttribute()
	{
		return Str::limit(strip_tags($this->intro), 70);
	}

	public function getFormattedPublishDateAttribute()
	{
		return Carbon::parse($this->published_at)->format('d.m.Y.');
	}

	public function getUrlAttribute()
	{
		return url()->route('newsItem', ['slug' => $this->slug]);
	}
}