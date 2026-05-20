<template>
	<li :class="cssClasses" ref="li">
		<a :href="url">{{ name }}</a>

		<slot></slot>
	</li>
</template>

<script>
	export default {
		props: [
			'hasSubpages',
			'isActive',
			'url',
			'name'
		],

		data: function() {
			return {
				li: null
			}
		},

		mounted: function() {
			this.li = $(this.$refs.li);

			if (this.hasSubpages && !this.isActive) {
				const subpages = this.li.find('ul');

				this.li.hoverIntent({
					over: () => {
						if (!this.isMobile()) {
							subpages.slideDown(150);
						}
					},

					out: () => {
						if (!this.isMobile()) {
							subpages.slideUp(150);
						}
					}
				});
			}
		},

		methods: {
			isMobile: function() {
				return $(window).outerWidth() <= 991;
			}
		},

		computed: {
			cssClasses: function() {
				const classes = [];

				if (this.hasSubpages) {
					classes.push('has-subpages');
				}

				if (this.isActive) {
					classes.push('active');
				}

				return classes;
			}
		}
	}
</script>