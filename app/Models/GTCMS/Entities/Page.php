<?php

namespace App\Models\GTCMS\Entities;

use GTCrais\GTCMS\Resources\Concerns\SetsDepth;
use GTCrais\GTCMS\Resources\Concerns\SetsPosition;
use GTCrais\GTCMS\Resources\Concerns\SetsSlug;
use App\Models\Page as PageModel;
use GTCrais\GTCMS\Resources\Entity;

class Page extends PageModel
{
	use Entity;
	use SetsPosition;
	use SetsSlug;
	use SetsDepth;

	protected $with = ['pages'];

	public function pages()
	{
		return $this->hasMany(Page::class)->orderBy($this->entityConfig()->structure('position.property'));
	}

	public static function featuredPagesList()
	{
		return static::where('depth', '>', 0)->orderBy('name_en')->pluck('name_en', 'id');
	}

	public function pageSections()
	{
		return $this->hasMany(PageSection::class)->orderBy('position_in_page');
	}

	public function getModelKeyValueAttribute()
	{
		return self::modelKeyList()[$this->model_key] ?? null;
    }

	public static function getAdditionalAddData()
	{
		return self::getAdditionalFormData();
    }

	public static function getAdditionalEditData($object)
	{
		return self::getAdditionalFormData();
    }

	protected static function getAdditionalFormData()
	{
		return ['empty_page_section' => new PageSection([])];
    }

	public static function editWith()
	{
		return ['pageSections'];
    }

	public static function editWithout()
	{
		return ['pages'];
    }

	public static function pageTypeList()
	{
		return [
			'standard' => 'Standard page',
			'forms' => 'Standard page with forms',
			'tos' => 'Terms & Conditions page',
			'privacy' => 'Privacy Policy page',
			'cookies' => 'Cookies Notice page'
		];
	}

	public static function modelKeyList()
	{
		return [
			'fullWidthHeader' => 'Full width header',
			'headerWithText' => 'Header with text',
		];
	}

	public function getAllowedActionsAttribute()
	{
		return [
			'edit' => true,
			'view' => true,
			'delete' => $this->userCanDeletePage()
		];
	}

	public static function addActionAllowed()
	{
		return !static::where('depth', 0)->count();
	}

	protected function userCanDeletePage()
	{
		return (auth()->user()->role == 'superadmin') || ($this->depth > 0);
	}
}
