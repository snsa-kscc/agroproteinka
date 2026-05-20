<?php

return [

	'uid' => 'misc',
	'fqcn' => App\Models\GTCMS\Entities\Misc::class,
	'type' => 'model',
	'singularName' => 'Misc',
	'pluralName' => 'Misc',
	'iconClass' => 'fa fa-users',

	'structure' => [
		'type' => 'keyValue'
	],

	'form' => [
		'labelWidth' => 3,
		'inputWidth' => 9
	],

	'fields' => [

		[
			'property' => 'twitter_link',
			'label' => 'Twitter',
			'type' => 'text',
			'validationRules' => 'nullable|url',
		],
		[
			'property' => 'linked_in_link',
			'label' => 'Linked In',
			'type' => 'text',
			'validationRules' => 'nullable|url',
		],
		[
			'property' => 'google_link',
			'label' => 'Google',
			'type' => 'text',
			'validationRules' => 'nullable|url',
		],
		[
			'property' => 'facebook_link',
			'label' => 'Facebook',
			'type' => 'text',
			'validationRules' => 'nullable|url',
		],
		[
			'property' => 'report_contact_number',
			'label' => 'Report contact number',
			'type' => 'text',
			'validationRules' => 'nullable',
		],

		[
			'property' => 'gdpr_notice',
			'label' => 'GDPR notice',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
		],
		[
			'property' => 'cookie_notice',
			'label' => 'Cookie notice',
			'type' => 'textarea',
			'options' => [
				'rows' => 3
			],
			'translatable' => true,
			'validationRules' => '',
		],
		[
			'property' => 'report_contact',
			'label' => 'Report fallen animal contact',
			'type' => 'text',
			'translatable' => true,
			'validationRules' => '',
		],
		[
			'property' => 'footer_info_left',
			'label' => 'Footer info (left)',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
		],
		[
			'property' => 'footer_info_right',
			'label' => 'Footer info (right)',
			'type' => 'editor',
			'translatable' => true,
			'validationRules' => '',
		],

	]

];

