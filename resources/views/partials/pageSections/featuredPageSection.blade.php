
<section class="{{ $sectionHelper->sectionClass() }}">
	<div class="container-fluid">
		<div class="row {{ $sectionHelper->rowClass() }}">

			@if ($sectionHelper->imagePosition() == 'left')

				<div class="col-12 col-lg-6 d-flex justify-content-lg-end align-items-start">
					<div class="section-img-container position-title-line d-flex justify-content-lg-end position-relative">
						<img src="{{ $featuredPage->imageUrl('intro_image') }}"
							 alt="Section image"
							 class="animated delay-short fast section-img masked skew-left"
							 data-animation="fadeInLeft"
						>
					</div>
				</div>

			@endif

			<div class="col-12 col-lg-6 {{ $sectionHelper->outerContentContainerClass() }}">
				<div class="content-container {{ $sectionHelper->contentContainerClass() }} d-flex justify-content-lg-end">
					<div class="inner-content-container">
						<div class="text-container {{ $sectionHelper->textContainerClass() }}">
							@if ($featuredPage->show_featured_title)
									<h2>{{ $featuredPage->trans('name') }}</h2>
							@endif
							{!! $featuredPage->trans('intro') !!}
						</div>

						@include('partials.moreButton', ['url' => $featuredPage->url])

					</div>
				</div>
			</div>

			@if ($sectionHelper->imagePosition() == 'right')

				<div class="col-12 col-lg-6">
					<div class="section-img-container position-relative {{ $sectionHelper->imagePositionClass() }}">
						<img src="{{ $featuredPage->imageUrl('intro_image') }}"
							 alt="Section image"
							 class="animated delay-short fast section-img masked skew-right"
							 data-animation="fadeInRight"
						>
					</div>
				</div>

			@endif

		</div>
	</div>
</section>