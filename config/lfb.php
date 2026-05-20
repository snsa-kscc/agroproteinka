<?php

return [

	'pageClass' => \App\Models\Page::class,
	'viewComposerClass' => \App\Http\View\Composers\PageComposer::class,

	'useViewComposer' => true,
	'shareDefaultViewDataWith' => [
		'layouts.default'
	],
	'injectDefaultPageObject' => true,

	'defaultMetaDescription' => '',
	'defaultMetaKeywords' => '',
	'defaultMetaTitle' => 'Agroproteinka',
	'metaTitleSeparator' => ' :: '

];


