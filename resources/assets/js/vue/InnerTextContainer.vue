<template>
	<div>
		<div class="inner-text-container position-relative" ref="container">
			<slot></slot>

			<div class="hide-text-gradient" :class="gradientClass"></div>
		</div>
		<div class="expand-text"
			 :class="expandButtonClass"
			 @click="expand"
		>
			<img src="/img/expand-content-arrow-2.svg" alt="Prikaži cijeli text" />
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'truncate',
			'animateTextMargin'
		],

		data: function() {
			return {
				container: null,
				innerContentContainer: null,
				maxHeight: 410,
				originalHeight: null,
				showExpandElements: false
			}
		},

		mounted: function() {
			this.container = $(this.$refs.container);
			this.innerContentContainer = this.container.closest('.inner-content-container');

			if (this.truncate && (this.container.outerHeight() > this.maxHeight)) {
				if (this.animateTextMargin) {
					this.innerContentContainer.addClass('no-text-margin');
				}

				this.originalHeight = this.container.outerHeight();
				this.container.css('height', this.maxHeight + 'px');
				this.showExpandElements = true;
			}
		},

		methods: {
			expand: function() {
				this.container.css('height', this.originalHeight + 'px');

				if (this.animateTextMargin) {
					this.innerContentContainer.css('margin-bottom', '135px');
				}

				this.showExpandElements = false;
			}
		},

		computed: {
			expandButtonClass: function() {
				return !this.showExpandElements ? 'expand-button-hidden' : '';
			},

			gradientClass: function() {
				return !this.showExpandElements ? 'gradient-hidden' : '';
			}
		}
	}
</script>