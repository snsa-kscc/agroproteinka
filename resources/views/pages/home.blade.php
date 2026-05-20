@extends('layouts.default')

@section('content')

	@foreach ($page->featuredPages as $featuredPage)

		@include('partials.pageSections.featuredPageSection', [
			'featuredPage' => $featuredPage,
			'sectionHelper' => $sectionHelper->setIteration($loop->iteration)
		])

	@endforeach

	@if (app()->getLocale() == 'hr')

		<!-- <news-slider
			slider-title="{{ trans('web.news') }}"
			archive="{{ trans('web.archive') }}"
			:news-items="{{ json_encode($newsItems) }}"
			:initial-news-item="{{ json_encode($initialNewsItem) }}"
		>
		</news-slider> -->

	<section class="section-gray news-wrapper">
	 <!--Facebook Feed Section -->
	<section class="section-gray slider-container news-slider" id="facebook-feed-section">
		<div class="container-fluid narrow-container wide-title">
			<a href='https://www.facebook.com/www.agroproteinka.hr' target="_blank" rel="noopener noreferrer" class="text-decoration-none"><h2>{{ trans('web.facebook_feed') }}</h2></a>
		</div>

		<div class="container-fluid narrow-title">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="offset-container">
						<a href='https://www.facebook.com/www.agroproteinka.hr' target="_blank" rel="noopener noreferrer" class="text-decoration-none"><h2>{{ trans('web.facebook_feed') }}</h2></a>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid narrow-container position-relative">
			<div id="facebook-posts-container" class="row">
				 Facebook posts will be loaded here by React 
			</div>
		</div>
	</section>

	 <!--LinkedIn Feed Section -->
	<section class="section-gray slider-container news-slider" id="linkedin-feed-section">
		<div class="container-fluid narrow-container wide-title">
			<a href='https://www.linkedin.com/company/agroproteinka-d.d.' target="_blank" rel="noopener noreferrer" class="text-decoration-none"><h2>{{ trans('web.linkedin_feed') }}</h2></a>
		</div>

		<div class="container-fluid narrow-title">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="offset-container">
						<a href='https://www.linkedin.com/company/agroproteinka-d.d.' target="_blank" rel="noopener noreferrer" class="text-decoration-none"><h2>{{ trans('web.linkedin_feed') }}</h2></a>
					</div>
				</div>
			</div>
		</div>

		<div class="container-fluid narrow-container position-relative">
			<div id="linkedin-posts-container" class="row">
				 LinkedIn posts will be loaded here by React 
			</div>
		</div>
	</section>
	</section>

	@endif

@endsection


