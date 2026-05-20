<?php

return [

	'uid' => 'page',
	'fqcn' => App\Models\GTCMS\Entities\Page::class,
	'type' => 'model',
	'singularName' => 'Page',
	'pluralName' => 'Pages',
	'representedBy' => 'name',
	'iconClass' => 'fa fa-book',

	'structure' => [
		'type' => 'tree',
		'parentProperty' => 'page_id',
		'childrenMethod' => 'pages',
		'slug' => [
			'from' => 'name',
			'property' => 'slug',
			'skipForBaseDepth' => true
		],
		'position' => [
			'property' => 'position'
		],
		'depth' => [
			'property' => 'depth',
			'max' => 1
		],
	],

	'fieldTabs' => [
		'common' => 'Common',
		'meta' => 'MetaData'
	],

	'fields' => [

		[
			'property' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'translatable' => true,
			'validationRules' => 'required',
			'order' => true,
			'fieldTab' => 'common'
		],
		[
			'property' => 'page_type',
			'label' => 'Page type',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'pageTypeList'
			],
			'validationRules' => 'required',
			'default' => 'standard',
			'options' => [
				'clearable' => false
			],
			'fieldTab' => 'common'
		],
		[
			'property' => 'model_key',
			'label' => 'Header type',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'modelKeyList'
			],
			'validationRules' => 'required',
			'default' => 'fullWidthHeader',
			'options' => [
				'clearable' => false
			],
			'fieldTab' => 'common'
		],
		[
			'property' => 'is_active',
			'label' => 'Is active',
			'type' => 'checkbox',
			'default' => 1,
			'fieldTab' => 'common'
		],
		[
			'property' => 'no_footer_margin',
			'label' => 'No footer margin',
			'type' => 'checkbox',
			'default' => 1,
			'fieldTab' => 'common',
			'viewableForRoles' => [
				'superadmin'
			]
		],
		[
		    'property' => 'featured_pages',
		    'label' => 'Featured pages',
		    'type' => 'selectMany',
			'select' => [
				'class' => App\Models\GTCMS\Entities\Page::class,
				'listMethod' => 'featuredPagesList',
				'relationMethod' => 'featuredPages',
				'position' => [
					'property' => 'position'
				]
			],
			'validationRules' => '',
			'fieldTab' => 'common'
		],
		[
			'property' => 'title',
			'label' => 'Title',
			'type' => 'text',
			'translatable' => true,
			'validationRules' => 'required',
			'order' => true,
			'fieldTab' => 'common'
		],
		[
			'property' => 'header_image',
			'label' => 'Header image',
			'type' => 'file',
			'imageFile' => true,
			'validationRules' => 'required',
			'uploadRules' => 'image',
			'transforms' => [
				[957, 1030, 'fit', 'header-with-text', 100],
				[null, 580, 'resize', 'default', 100]
			],
			'fieldTab' => 'common'
		],
		[
		    'property' => 'intro_image',
		    'label' => 'Featured image',
		    'type' => 'file',
			'imageFile' => true,
		    'validationRules' => '',
			'uploadRules' => 'image',
			/*'minimumDimensions' => [
				'width' => 616,
				'height' => 604
			],*/
		    'transforms' => [
		        [616, 604, 'fit', 'default', 100],
		    ],
			'fieldTab' => 'common'
		],
		[
			'property' => 'header_image_title',
			'label' => 'Header image title',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
			'options' => [
				'plugins' => 'paste',
				'toolbar' => 'undo redo',
				'forced_root_block' => false,
				'height' => 145
			],
			'fieldTab' => 'common'
		],
		[
			'property' => 'header_text',
			'label' => 'Header text',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
			'fieldTab' => 'common'
		],
		[
			'property' => 'intro',
			'label' => 'Featured text',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
			'fieldTab' => 'common'
		],
		[
			'property' => 'meta_keywords',
			'label' => 'Meta keywords',
			'type' => 'textarea',
			'translatable' => true,
			'validationRules' => '',
			'options' => [
				'rows' => 3
			],
			'fieldTab' => 'meta'
		],
		[
			'property' => 'meta_description',
			'label' => 'Meta description',
			'type' => 'textarea',
			'translatable' => true,
			'validationRules' => '',
			'options' => [
				'rows' => 3
			],
			'fieldTab' => 'meta'
		],

	]

];

