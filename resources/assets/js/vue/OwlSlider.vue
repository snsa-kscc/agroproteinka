<template>
	<section class="slider-container" :class="sliderClasses">

		<div v-if="sliderTitle" class="container-fluid">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="offset-container">
						<h2>{{ sliderTitle }}</h2>
					</div>
				</div>
			</div>
		</div>

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
					next: this.next
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