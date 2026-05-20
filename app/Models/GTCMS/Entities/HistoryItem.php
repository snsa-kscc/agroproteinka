<?php

namespace App\Models\GTCMS\Entities;

use App\Models\HistoryItem as HistoryItemModel;
use GTCrais\GTCMS\Resources\Entity;
use Illuminate\Database\Eloquent\Builder;

class HistoryItem extends HistoryItemModel
{
    use Entity;

	public function scopeIndexQuery(Builder $query)
	{
		return $query->orderBy('year', 'desc');
    }

}
