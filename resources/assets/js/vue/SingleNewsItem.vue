<template>
	<section class="section-textImage section-single-news for-full-width-header section-white">
		<div class="outer-section-container">
			<div class="container-fluid">
				<div class="row flex-column-reverse flex-lg-row">

					<div class="col-12 col-lg-6 left-col col-lg-6x">
						<div class="content-container big-indent d-flex justify-content-lg-end">
							<div class="inner-content-container">
								<div class="text-container">
									<h2>{{ selectedNews.title }}</h2>

									<div v-html="selectedNews.content"></div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-12 col-lg-6 slider-container news-image-slider-container d-flex justify-content-lg-end align-items-start"
						 :class="sliderClasses"
						 ref="imageSliderContainer"
					>
						<div class="section-img-container position-relative position-text-line">
							<div class="fake-nav-container left-container">
								<div class="nav-arrow nav-arrow-left"
									 :class="{ hover: arrowHover.left }"
									 @click.prevent="prev"
									 @mouseenter="onHover('left')"
									 @mouseleave="offHover('left')"
								>
									<img src="/img/slider/slider-arrow-left-background.svg" alt="Move left" />
									<img src="/img/slider/slider-arrow-left.svg" class="arrow-img" alt="Move left" />
								</div>
							</div>

							<div class="fake-nav-container right-container">
								<div class="nav-arrow nav-arrow-right"
									 :class="{ hover: arrowHover.right }"
									 @click.prevent="next"
									 @mouseenter="onHover('right')"
									 @mouseleave="offHover('right')"
								>
									<img src="/img/slider/slider-arrow-right-background.svg" alt="Move right" />
									<img src="/img/slider/slider-arrow-right.svg" class="arrow-img" alt="Move right" />
								</div>
							</div>

							<div class="news-image-slider owl-carousel"
								 ref="gallerySlider"
							>
								<img
									v-for="image in selectedNews.ordered_images"
									:src="image.image_url"
									alt="News image"
									class="section-img masked skew-right"
									data-animation="fadeInRight"
								>
							</div>

							<div class="real-nav-container left-container">
								<div class="nav-button left"
									 @click.prevent="prev"
									 @mouseenter="onHover('left')"
									 @mouseleave="offHover('left')"
								>
								</div>
							</div>

							<div class="real-nav-container right-container">
								<div class="nav-button right"
									 @click.prevent="next"
									 @mouseenter="onHover('right')"
									 @mouseleave="offHover('right')"
								>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>
</template>

<script>

	import TranslationMixin from "../mixins/TranslationMixin";

	export default {
		mixins: [TranslationMixin],

		props: [
			'selectedNews'
		],

		data: function() {
			return {
				newsImageSliderContainer: null,
				carousel: null,
				nextEnabled: true,
				prevEnabled: true,
				transparent: true,
				arrowHover: {
					left: false,
					right: false
				}
			}
		},

		mounted: function() {
			this.newsImageSliderContainer = $(this.$refs.imageSliderContainer)

			this.$nextTick(() => {
				this.newsImageSliderContainer.imagesLoaded(() => {
					this.setupSlider();
				});
			});
		},

		methods: {
			setupSlider: function() {
				this.carousel = $(this.$refs.gallerySlider).owlCarousel({

					items: 1,
					slideBy: 1,
					dots: false,
					autoHeight: true,

					onChanged: (event) => {
						this.prevEnabled = event.item.index > 0;
						this.nextEnabled = (event.item.index + 1) < event.item.count;
					}

				});

				setTimeout(() => {
					this.transparent = false;
				}, 250);
			},

			prev: function() {
				this.carousel.trigger('prev.owl.carousel');
			},

			next: function() {
				this.carousel.trigger('next.owl.carousel');
			},

			onHover: function(arrow) {
				this.arrowHover[arrow] = true;
			},

			offHover: function(arrow) {
				this.arrowHover[arrow] = false;
			}
		},

		computed: {
			sliderClasses: function() {
				const classes = [];

				if (this.transparent) {
					classes.push('transparent');
				}

				if (!this.nextEnabled) {
					classes.push('next-disabled');
				}

				if (!this.prevEnabled) {
					classes.push('prev-disabled');
				}

				return classes;
			}
		}
	}
</script>