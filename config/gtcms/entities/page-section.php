<?php

return [

	'uid' => 'page-section',
	'fqcn' => App\Models\GTCMS\Entities\PageSection::class,
	'type' => 'model',
	'singularName' => 'Page section',
	'pluralName' => 'Page sections',
	'representedBy' => 'id',
	'iconClass' => 'fa fa-book',

	'structure' => [
		'type' => 'list',
		'orderBy' => 'created_at',
		'direction' => 'desc',
		'perPage' => 10,
	],

	'fields' => [

		[
			'property' => 'type',
			'label' => 'Type',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'typeList'
			],
			'validationRules' => 'required',
			'default' => 'textImage',
			'options' => [
				'clearable' => false
			]
		],
		[
			'property' => 'section_image',
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
				[775, 1238, 'fit', 'leftTrapezoid', 100],
				[789, 1634, 'fit', 'rightTrapezoid', 100],
			]
		],
		[
			'property' => 'render_option',
			'label' => 'Render option',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'renderOptionList'
			],
			'validationRules' => '',
			'viewableForRoles' => [
				'superadmin'
			],
			'fieldTab' => 'common'
		],
		[
			'property' => 'image_render_option',
			'label' => 'Image render option',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'imageRenderOptionList'
			],
			'validationRules' => '',
			'viewableForRoles' => [
				'superadmin'
			]
		],
		[
		    'property' => 'title',
		    'label' => 'Title',
		    'type' => 'text',
		    'validationRules' => '',
			'translatable' => true
		],
		[
		    'property' => 'content_1',
		    'label' => 'Content (first)',
		    'type' => 'editor',
			'translatable' => true,
		    'validationRules' => '',
			'options' => [
				'plugins' => 'link paste table',
				'toolbar' => 'undo redo | h2 h3 | bold italic | link unlink | table',
				'table_toolbar' => 'tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow',
				'table_appearance_options' => '',
				'table_advtab' => false,
				'table_cell_advtab' => false,
				'table_row_advtab' => false,
				'table_resize_bars' => false,
			]
		],
		[
			'property' => 'content_2',
			'label' => 'Content (second)',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
			'options' => [
				'plugins' => 'link paste table',
				'toolbar' => 'undo redo | h2 h3 | bold italic | link unlink | table',
				'table_toolbar' => 'tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow',
				'table_appearance_options' => '',
				'table_advtab' => false,
				'table_cell_advtab' => false,
				'table_row_advtab' => false,
				'table_resize_bars' => false,
			]
		]

	]

];

