<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="format-detection" content="telephone=no, email=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">

		<title>{{ $metaManager->getMetaTitle() }}</title>
		<meta name="description" content="{{ $metaManager->getMetaDescription() }}" />
		<meta name="keywords" content="{{ $metaManager->getMetaKeywords() }}" />

		<meta property="og:title" content="{{ $metaManager->getMetaTitle() }}" />
		<meta property="og:description" content="{{ $metaManager->getMetaDescription() }}">
		<meta property="og:type" content="website" />
		<meta property="og:url" content="{{ request()->url() }}" />

		@if (!empty($initialNewsItem) && $initialNewsItem->orderedImages->count())
			<meta property="og:image" content="{{ request()->getScheme() }}://{{ request()->server ("HTTP_HOST") . $initialNewsItem->orderedImages->first()->image_url }}" />
			<meta property="og:image:width" content="616" />
			<meta property="og:image:height" content="604" />
		@else
			<meta property="og:image" content="{{ request()->getScheme() }}://{{ request()->server ("HTTP_HOST") }}/img/shareImg.png" />
			<meta property="og:image:width" content="1200" />
			<meta property="og:image:height" content="630" />
		@endif

		<link href="https://fonts.googleapis.com/css?family=Roboto:500&display=swap&subset=latin-ext" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset("web/css/vendor.css?v=" . config('assetversioning.front.cssVendors')) }}">
		<link rel="stylesheet" href="{{ asset("web/css/web.css?v=" . config('assetversioning.front.css')) }}">

		<link rel="shortcut icon" href="{{asset("img/favicon.ico?v=" . config('assetversioning.front.favicon'))}}">

		<link rel="stylesheet" href="{{ asset('web/vite/app.css') }}">
		<script type="module" src="{{ asset('web/vite/app.js') }}"></script>

	</head>
	<body>
		<div id="wrap" class="page-{{ $page->pageKey }} d-flex flex-column">

			@include('partials.' . $page->headerType)

			<div class="content-wrapper flex-fill">
				@yield('content')
			</div>

			@include('partials.footer')

			<scroll-to-top></scroll-to-top>

		</div>

		<script>
			window.localePrefix = "{{ $localePrefix }}";
			window.misc = {!! $misc !!};
			window.locale = "{{ app()->getLocale() }}"
		</script>

		<script src="{{ asset("/web/js/manifest.js?v=" . config('assetversioning.front.jsVendors')) }}"></script>
		<script src="{{ asset("/web/js/vendor.js?v=" . config('assetversioning.front.jsVendors')) }}"></script>
		<script src="{{ asset("/web/js/web.js?v=" . config('assetversioning.front.js')) }}"></script>
	</body>
</html>
