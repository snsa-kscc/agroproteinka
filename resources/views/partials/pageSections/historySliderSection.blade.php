<history-slider slider-title="{{ $sliderTitle }}" section-cls="{{ $sectionClass ?? '' }}">
	<template v-slot:default="slotProps" v-cloak>

		@foreach ($slides as $slide)

			<section>
				<div class="container-fluid">
					<div class="row">
						<div class="col-12 col-lg-6 d-flex justify-content-lg-end">
							<div class="content-container big-indent d-flex justify-content-lg-end">
								<div class="inner-content-container position-relative">

									<div class="timeline-circle d-none d-lg-block"></div>

									<div class="text-container">

										@if ($slide->title())

											<h2 class="with-dash">{{ $slide->title() }}</h2>

										@endif

										{!! $slide->trans('content') !!}

									</div>

									<div class="d-none d-lg-block left-real-nav-container">
										<a href="#"
										   class="d-inline-block nav-arrow nav-arrow-left real-nav"
										   @click.prevent="slotProps.prev"
										   @mouseenter="slotProps.onHover('left')"
										   @mouseleave="slotProps.offHover('left')"
										>
											<img src="/img/nav_arrow_left.svg" alt="Move left"/>
										</a>
									</div>
								</div>
							</div>
						</div>

						<div class="col-12 col-lg-6">
							<div class="section-img-container position-relative {{ $imagePosition ?? '' }} {{ $skewClass }}">

								<img src="{{ $slide->imageUrl() }}"
									 alt="Section image"
									 class="section-img masked {{ $skewClass }} {{ $loop->iteration == 1 ? 'animated fast' : '' }}"
									 data-animation="fadeInRight"
								>

								<a href="#"
								   class="nav-arrow nav-arrow-right real-nav d-none d-lg-block"
								   @click.prevent="slotProps.next"
								   @mouseenter="slotProps.onHover('right')"
								   @mouseleave="slotProps.offHover('right')"
								>
									<img src="/img/nav_arrow_right.svg" alt="Move left"/>
								</a>
							</div>
						</div>
					</div>
				</div>
			</section>

		@endforeach

	</template>
</history-slider>


