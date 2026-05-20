<?php

return [

	'uid' => 'history-item',
	'fqcn' => App\Models\GTCMS\Entities\HistoryItem::class,
	'type' => 'model',
	'singularName' => 'History event',
	'pluralName' => 'History',
	'representedBy' => 'year',
	'iconClass' => 'fa fa-users',

	'structure' => [
		'type' => 'list',
		'orderBy' => 'id',
		'direction' => 'desc',
		'perPage' => 10,
	],

	'fields' => [

		[
		    'property' => 'year',
		    'label' => 'Year',
		    'type' => 'text',
		    'validationRules' => 'required',
			'numeric' => [
				'decimal' => false,
				'negative' => false
			],
			'index' => [
				'link' => true
			]
		],
		[
			'property' => 'is_active',
			'label' => 'Is active',
			'type' => 'checkbox',
			'default' => 1,
			'index' => true
		],
		[
			'property' => 'history_image',
			'label' => 'Image',
			'type' => 'file',
			'imageFile' => true,
			'validationRules' => 'required',
			'uploadRules' => 'image',
			'minimumDimensions' => [
				'width' => 616,
				'height' => 604
			],
			'transforms' => [
				[616, 604, 'fit', 'default', 100],
			]
		],
		[
			'property' => 'content',
			'label' => 'Content',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => 'required',
		]

	]

];

