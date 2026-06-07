<?php

namespace App\Models;

use App\Models\Concerns\Translatable;
use App\Services\TranslationHelper;
use GTCrais\LFB\Contracts\HasMetaData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements HasMetaData
{
	use Translatable;

    protected $fillable = [
		'page_id', 'depth', 'position', 'model_key', 'is_active',
		'show_featured_title',
		'intro_image', 'header_image', 'page_type', 'no_footer_margin',

		'name_hr', 'slug_hr', 'title_hr', 'lead_hr', 'content_hr',
		'meta_keywords_hr', 'meta_description_hr', 'intro_hr',
		'header_text_hr', 'header_image_title_hr',

		'name_en', 'slug_en', 'title_en', 'lead_en', 'content_en',
		'meta_keywords_en', 'meta_description_en', 'intro_en',
		'header_text_en', 'header_image_title_en'
	];
    protected $translationHelper;

	public function __construct(array $attributes = [])
	{
		parent::__construct($attributes);

		$this->translationHelper = app(TranslationHelper::class);
    }

	public function pages()
	{
		return $this->hasMany(Page::class);
    }

	public function orderedPages()
	{
		return $this->pages()->orderBy('position');
    }

	public function parentPage()
	{
		return $this->belongsTo(Page::class);
    }

	public function featuredPages()
	{
		return $this->belongsToMany(Page::class, null, null, 'featured_page_id')->orderBy('page_page.position');
	}

	public function pageSections()
	{
		return $this->hasMany(PageSection::class)->orderBy('position_in_page');
    }

	public function filteredPageSections()
	{
		if ($this->model_key == 'fullWidthHeader') {
			return $this->pageSections;
		}

		return $this->pageSections->filter(function($pageSection) {
			return in_array($pageSection->type, ['textImage', 'imageText']);
		});
    }

	public function hasHistorySection()
	{
		return !!$this->pageSections->firstWhere('type', 'history');
    }

	public function scopeNavigationPages($query)
	{
		/** @var Builder $query */
		return $query->where('depth', 1)
			->whereIn('page_type', ['standard', 'forms'])
			->active()
			->orderBy('position');
    }

	public function scopeLegalPages($query)
	{
		/** @var Builder $query */
		return $query->where('depth', 1)
			->whereIn('page_type', ['tos', 'privacy', 'cookies'])
			->active()
			->orderBy('position');
	}

	public function scopeActive($query)
	{
		/** @var Builder $query */
		return $query->where('is_active', 1);
    }

	public function isActive($currentPage)
	{
		return $this->id == $currentPage->id;
	}

	public function imageUrl($property, $folder = 'default')
	{
		return '/storage/img/entity-images/page/' . $folder . '/' . $this->{$property};
    }

	public function getViewKeyAttribute()
	{
		return $this->depth == 0 ? 'home' : 'default';
    }

    public function getPageKeyAttribute()
    {
        return $this->model_key ?: 'p404';
    }

	public function getHeaderTypeAttribute()
	{
		return $this->model_key;
	}

	public function getUrlAttribute()
	{
		return route('default', ['segments' => $this->trans('slug')]);
	}

	public function urlForOppositeLocale()
	{
		return $this->urlForLocale($this->translationHelper->oppositeLocale());
	}

	public function urlForLocale($locale)
	{
		return $this->translationHelper->localePrefix($locale) . $this->trans('slug', $locale);
	}

	public function getMetaDescription()
	{
		return $this->trans('meta_description');
	}

	public function getMetaKeywords()
	{
		return $this->trans('meta_keywords');
	}

	public function getMetaTitle()
	{
		return $this->trans('name');
	}
}
