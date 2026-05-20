<?php

return [

	'uid' => 'news-item',
	'fqcn' => App\Models\GTCMS\Entities\NewsItem::class,
	'type' => 'model',
	'singularName' => 'News',
	'pluralName' => 'News',
	'representedBy' => 'title',
	'iconClass' => 'fa fa-users',

	'structure' => [
		'type' => 'list',
		'slug' => [
			'from' => 'title',
			'property' => 'slug'
		],
		'orderBy' => 'published_at',
		'direction' => 'desc',
		'perPage' => 10,
	],

	'sideView' => [
		'add' => 'news-item-image-add',
		'edit' => 'news-item-image-edit',
	],

	'events' => [
		'onAdd' => 'edit'
	],

	'fields' => [

		[
			'property' => 'title',
			'label' => 'Title',
			'type' => 'text',
			'validationRules' => 'required|max:150',
			'options' => [
				'maxlength' => 150
			],
			'index' => [
				'link' => true
			]
		],
		[
		    'property' => 'url',
		    'label' => 'URL',
		    'type' => 'text',
			'hidden' => ['add', 'edit'],
			'index' => true
		],
		[
		    'property' => 'excerpt',
		    'label' => 'Excerpt',
		    'type' => 'text',
			'hidden' => ['add', 'edit'],
			'index' => true
		],
		[
			'property' => 'published_at',
			'displayValue' => [
				'type' => 'accessor',
				'method' => 'formattedPublishDate'
			],
			'label' => 'Publish date',
			'type' => 'date',
			'validationRules' => 'required|date_format:Y-m-d',
			'default' => now('Europe/Zagreb'),
			'index' => true
		],
		[
			'property' => 'is_active',
			'label' => 'Is active',
			'type' => 'checkbox',
			'default' => 1,
			'index' => true
		],
		[
			'property' => 'intro',
			'label' => 'Intro',
			'type' => 'textarea',
			'validationRules' => 'required|max:200',
			'options' => [
				'maxlength' => 200,
				'rows' => 4
			]
		],
		[
			'property' => 'content',
			'label' => 'Content',
			'type' => 'editor',
			'validationRules' => 'required',
		]

	]

];

