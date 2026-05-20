<?php

namespace App\Models\GTCMS\Entities;

use GTCrais\GTCMS\Resources\Concerns\SetsPosition;
use GTCrais\GTCMS\Resources\Entity;
use App\Models\NewsItemImage as NewsItemImageModel;

class NewsItemImage extends NewsItemImageModel
{
    use Entity;
    use SetsPosition;

	protected $appends = [
		'thumbnail_url', 'represented_by'
	];

	public function getRepresentedByAttribute()
	{
		return "Gallery Image";
    }

	public function getThumbnailUrlAttribute()
	{
		return '/storage/img/entity-images/news-item-image/gtcms-thumbnail/' . $this->imagename;
	}
}