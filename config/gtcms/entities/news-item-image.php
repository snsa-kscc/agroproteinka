<?php

return [

	'uid' => 'news-item-image',
	'fqcn' => App\Models\GTCMS\Entities\NewsItemImage::class,
	'type' => 'model',
	'singularName' => 'Image',
	'pluralName' => 'Images',
	'representedBy' => 'represented_by',
	'iconClass' => 'fa fa-book',

	'structure' => [
		'type' => 'list',
		'orderBy' => 'created_at',
		'direction' => 'desc',
		'perPage' => 1,
		'position' => [
			'property' => 'position'
		]
	],

	'fields' => [

		[
		    'property' => 'represented_by',
		    'label' => '...',
		    'type' => 'text',
		],
		[
			'property' => 'imagename',
			'label' => 'Image',
			'type' => 'file',
			'imageFile' => true,
			'validationRules' => '',
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
		    'property' => 'news_item_id',
		    'label' => 'News Item',
		    'type' => 'text',
		    'rules' => 'required',
		],

	]

];

