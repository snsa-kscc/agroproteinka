<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use Illuminate\Database\Eloquent\Model;

class PageSection extends Model
{
	use Translatable;

    protected $fillable = [
    	'page_id', 'section_image', 'position_in_page',
		'type', 'image_render_option', 'render_option',
		'title_en', 'content_1_en', 'content_2_en',
		'title_hr', 'content_1_hr', 'content_2_hr',
	];

	public function imageUrl($folder = 'default')
	{
		return '/storage/img/entity-images/page-section/' . $folder . '/' . $this->section_image;
	}
}
