<?php

namespace App\Models;

use GTCrais\LFB\Contracts\HasMetaData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model implements HasMetaData
{
    protected $fillable = [
    	'content', 'intro', 'title', 'published_at', 'is_active'
	];

    protected $appends = [
    	'year', 'formatted_date', 'image_url'
	];

    protected $dates = [
    	'published_at'
	];

	public function images()
	{
		return $this->hasMany(NewsItemImage::class);
    }

	public function orderedImages()
	{
		return $this->images()->orderBy('position');
    }

	public function scopePublished($query)
	{
		/** @var Builder $query */
		return $query->active()->whereDate('published_at', '<=', now());
    }

	public function scopeActive($query)
	{
		/** @var Builder $query */
		return $query->where('is_active', 1);
    }

	public function getImageUrlAttribute()
	{
		return '/storage/img/entity-images/news-item/default/' . $this->news_image;
	}

	public function getYearAttribute()
	{
		return optional($this->published_at)->year;
	}

	public function getFormattedDateAttribute()
	{
		if ($this->published_at) {
			return trans('days.' . $this->published_at->format('D')) . ' ' . $this->published_at->format('d m Y');
		}

		return null;
	}

	public function getMetaDescription()
	{
		return $this->intro;
	}

	public function getMetaKeywords()
	{
		return $this->intro;
	}

	public function getMetaTitle()
	{
		return $this->title;
	}
}
