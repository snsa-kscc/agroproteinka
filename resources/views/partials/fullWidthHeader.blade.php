<header>
	@include('partials.navigation')

	<div class="header-hero full-width-header-image-container position-relative animated header-animation"
		 style="background-image: url({!! $page->imageUrl('header_image') !!});"
		 data-animation="fadeIn"
	>

		<div class="container-fluid narrow-container d-flex align-items-center align-items-lg-end justify-content-center justify-content-lg-start h-100">
			<h1 class="animated header-animation faster" data-animation="fadeInRight">
				{{ $page->trans('title') }}
			</h1>
		</div>

		<img src="/img/hero_mask.png" class="hero-mask" alt="Mask" />
	</div>
</header>