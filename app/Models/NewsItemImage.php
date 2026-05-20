<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItemImage extends Model
{
    protected $fillable = [
    	'news_item_id', 'imagename', 'position'
	];

    protected $appends = [
    	'image_url'
	];

	public function getImageUrlAttribute()
	{
		return '/storage/img/entity-images/news-item-image/default/' . $this->imagename;
	}
}
