<template>
	<section class="slider-container position-relative" :class="sliderClasses">

		<div v-if="sliderTitle" class="container-fluid">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="offset-container">
						<h2>{{ sliderTitle }}</h2>
					</div>
				</div>
			</div>
		</div>

		<section class="fake-nav-container h-100 w-100">
			<div class="container-fluid h-100">
				<div class="row h-100">
					<div class="col-6 d-flex justify-content-lg-end">
						<div class="content-container big-indent d-flex justify-content-lg-end">
							<div class="inner-content-container position-relative">
								<div class="nav-arrow nav-arrow-left"
									 :class="{ hover: arrowHover.left }"
									 @click.prevent="slotProps.prev"
									 @mouseenter="slotProps.onHover('left')"
									 @mouseleave="slotProps.offHover('left')"
								>
									<img src="/img/slider/slider-arrow-left-background.svg" alt="Move left" />
									<img src="/img/slider/slider-arrow-left.svg" class="arrow-img" alt="Move left" />
								</div>
							</div>
						</div>
					</div>

					<div class="col-6">
						<div class="nav-arrow nav-arrow-right"
							 :class="{ hover: arrowHover.right }"
							 @click.prevent="slotProps.next"
							 @mouseenter="slotProps.onHover('right')"
							 @mouseleave="slotProps.offHover('right')"
						>
							<img src="/img/slider/slider-arrow-right-background.svg" alt="Move right" />
							<img src="/img/slider/slider-arrow-right.svg" class="arrow-img" alt="Move right" />
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="horizontal-line d-none d-lg-block w-100"></section>

		<div class="slider-sections owl-carousel" ref="sliderSections">

			<slot v-bind="slotProps"></slot>

		</div>
	</section>
</template>

<script>
	export default {
		props: [
			'sectionCls',
			'sliderTitle'
		],

		data: function() {
			return {
				carousel: null,
				nextEnabled: true,
				prevEnabled: true,
				slotProps: {
					prev: this.prev,
					next: this.next,
					onHover: this.onHover,
					offHover: this.offHover
				},
				arrowHover: {
					left: false,
					right: false
				}
			}
		},

		mounted: function() {
			this.setupSlider();
		},

		methods: {
			setupSlider: function() {
				this.carousel = $(this.$refs.sliderSections).owlCarousel({
					items: 1,
					dots: false,
					autoHeight: true,
					onChanged: (event) => {
						this.prevEnabled = event.item.index > 0;
						this.nextEnabled = (event.item.index + 1) < event.item.count;
					}
				});
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

				if (this.sectionCls) {
					classes.push(this.sectionCls);
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