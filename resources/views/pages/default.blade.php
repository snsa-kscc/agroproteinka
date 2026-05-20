@extends('layouts.default')

@section('content')

	@foreach ($page->filteredPageSections() as $pageSection)

		@if ($sectionHelper->setPage($page)->setPageSection($pageSection)->setIteration($loop->iteration)->isHistory())

			@include('partials.pageSections.historySliderSection', [
				'slides' => $historyItems,
				'sectionClass' => $sectionHelper->sectionClass(),
				'sliderTitle' => null,
				'skewClass' => 'skew-left'
			])

		@else

			@include('partials.pageSections.defaultPageSection', [
				'pageSection' => $pageSection,
				'sectionHelper' => $sectionHelper
			])

		@endif

	@endforeach

@endsection


