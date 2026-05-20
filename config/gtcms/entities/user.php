<?php

return [

	'uid' => 'user',
	'fqcn' => App\Models\GTCMS\Entities\User::class,
	'type' => 'model',
	'singularName' => 'User',
	'pluralName' => 'Users',
	'representedBy' => 'full_name',
	'iconClass' => 'fa fa-users',

	'structure' => [
		'type' => 'list',
		'orderBy' => 'created_at',
		'direction' => 'desc',
		'perPage' => 10,
	],

	'fields' => [

		[
		    'property' => 'adminEmail',
		    'label' => 'Email',
		    'type' => 'text',
		    'rules' => '',
			'hidden' => ['add', 'edit'],
			'index' => [
				'link' => true
			],
		],
		[
			'property' => 'email',
			'label' => 'Email',
			'type' => 'text',
			'validationRules' => 'required|unique:users,email,{objectId},id|email',
			'order' => true,
			'search' => [
				'type' => 'standard',
				'match' => 'pattern'
			],
			'quickSearch' => true
		],
		[
			'property' => 'password',
			'label' => 'Password',
			'type' => 'password',
			'validationRules' => [
				'add' => ['required']
			],
			'info' => [
				'edit' => 'Leave empty to keep current password'
			],
			'options' => [
				'autocomplete' => 'off'
			],
			'autofill' => false
		],
		[
			'property' => 'role',
			'displayValue' => [
				'type' => 'accessor',
				'method' => 'roleName'
			],
			'label' => 'Role',
			'type' => 'select',
			'select' => [
				'type' => 'list',
				'listMethod' => 'getUserRoles'
			],
			'validationRules' => 'required',
			'default' => 'user',
			'quickSearch' => true,
			'index' => true,
		],
		[
			'property' => 'name',
			'label' => 'Name',
			'type' => 'text',
			'validationRules' => 'required',
			'index' => true,
			'order' => true,
			'search' => [
				'type' => 'standard',
				'match' => 'pattern'
			],
			'quickSearch' => true
		]

	]

];

