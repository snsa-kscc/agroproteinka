<header>
	@include('partials.navigation')
</header>

<section class="header-section">
	<div class="container-fluid">
		<div class="row">

			<div class="col col-left animated header-animation header-with-text-image-container"
				 style="background-image: url({!! $page->imageUrl('header_image') !!});"
				 data-animation="fadeIn"
			>
				<div class="header-content-container position-relative d-flex justify-content-end">
					<img src="{{ $page->imageUrl('header_image', 'header-with-text') }}" alt="Header image" class="section-img header-mask">

					<div class="title d-flex d-lg-block align-items-center justify-content-center">
						<h1 class="d-none d-lg-block animated header-animation faster" data-animation="fadeInRight">
							{!! $page->trans('header_image_title') !!}
						</h1>

						<h1 class="d-block d-lg-none">
							{{ $page->trans('title') }}
						</h1>
					</div>
				</div>
			</div>

			<div class="col flex-grow-1">
				<div class="content-container d-flex justify-content-lg-end">
					<div class="inner-content-container">
						<div class="text-container">

							<h2 class="with-dash distant-dash">{{ $page->trans('title') }}</h2>

							{!! $page->trans('header_text') !!}
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</section>