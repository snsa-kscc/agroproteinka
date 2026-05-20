<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use App\Models\Contracts\Slide;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HistoryItem extends Model implements Slide
{
	use Translatable;

	protected $fillable = [
		'content_hr', 'content_en', 'year', 'is_active', 'history_image'
	];

	public function scopeActive($query)
	{
		/** @var Builder $query */
		return $query->where('is_active', 1);
	}

	public function title()
	{
		return $this->year;
	}

	public function imageUrl()
	{
		return '/storage/img/entity-images/history-item/default/' . $this->history_image;
	}
}
