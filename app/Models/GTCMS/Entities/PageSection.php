<?php

namespace App\Models\GTCMS\Entities;

use GTCrais\GTCMS\Resources\Entity;
use App\Models\PageSection as PageSectionModel;
use GTCrais\GTCMS\Services\DataProvider;

class PageSection extends PageSectionModel
{
    use Entity;

    protected $appends = ['entity_object_data'];

	public static function typeList()
	{
		return [
			'textImage' => 'Text + Image',
			'imageText' => 'Image + Text',
			'textText' => 'Text + Text (Only supported with "Full Width" header)',
			'imageOrderForm' => 'Image + Order form (Only supported with "Full Width" header)',
			'orderFormImage' => 'Order form + Image (Only supported with "Full Width" header)',
			'history' => 'History (Only supported with "Full Width" header type)',
			'text' => 'Text (Only supported with "Full Width" header type)',
		];
	}

	public static function imageRenderOptionList()
	{
		return [
			'pullUp' => 'Pull up'
		];
	}

	public static function renderOptionList()
	{
		return [
			'animateTextMargin' => 'Animate text margin'
		];
	}

	public function getEntityObjectDataAttribute()
	{
		$object = $this->id ? $this : null;
		$arrayObject = $object ? $object->makeHidden('entity_object_data')->toArray() : null;

		return ['object' => $arrayObject] + app(DataProvider::class)->getFieldData($this->entityConfig(), $object);
	}
}