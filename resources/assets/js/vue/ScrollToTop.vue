<template>
	<a href="#"
	   class="back-to-top d-flex justify-content-center align-items-center"
	   :class="{ 'is-visible': visible }"
	   @click.prevent="scrollToTop"
	>
		<img src="/img/up-arrow.svg" alt="Nazad na vrh" />
	</a>
</template>

<script>
	export default {
		props: [

		],

		data: function() {
			return {
				visible: false
			}
		},

		mounted: function() {
			this.setVisibility();
		},

		methods: {
			scrollToTop() {
				$('html, body').animate({
					scrollTop: 0
				}, 300);
			},

			setVisibility() {
				$(window).scroll(() => {
					if ($(window).scrollTop() >= 600) {
						this.visible = true;
					} else {
						this.visible = false;
					}
				});
			}
		},

		computed: {

		}
	}
</script>