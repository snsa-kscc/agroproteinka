
<section class="{{ $sectionHelper->sectionClass() }}">
	<div class="outer-section-container">

		@if ($sectionHelper->hasLeftBackgroundImage())

			<div class="left-background-image">
				@include('partials.pageSections.partials.leftBackgroundSvg')
			</div>

		@endif

		<div class="container-fluid">
			<div class="row {{ $sectionHelper->rowClass() }}">

				@if ($sectionHelper->imageIsLeft())

					@include('partials.pageSections.partials.pageSectionImage')

				@endif

				@if ($sectionHelper->fullWidthTitle())

					<div class="col-12 d-flex justify-content-end">
						<div class="offset-container">
							<h2>{{ $pageSection->trans('title') }}</h2>
						</div>
					</div>

				@endif

				@if ($sectionHelper->hasFullWidthContent())

					<div class="col-12 narrow-container mx-auto">

						@if ($pageSection->trans('title'))

							<h2>{{ $pageSection->trans('title') }}</h2>

						@endif

						{!! $pageSection->trans('content_1') !!}

					</div>

				@endif

				@if ($sectionHelper->hasLeftContent())

					@include('partials.pageSections.partials.pageSectionContent', [
						'text' => $sectionHelper->getLeftText(),
						'contentContainerClass' => $sectionHelper->leftContentContainerClass()
					])

				@endif

				@if ($sectionHelper->hasRightContent())

					@include('partials.pageSections.partials.pageSectionContent', [
						'text' => $sectionHelper->getRightText()
					])

				@endif

				@if ($sectionHelper->imageIsRight())

					@include('partials.pageSections.partials.pageSectionImage')

				@endif

			</div>
		</div>
	</div>
</section>