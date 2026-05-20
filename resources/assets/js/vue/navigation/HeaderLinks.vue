<template>
	<div class="main-links position-relative d-flex align-items-stretch align-items-lg-center"
		 :class="{ 'menu-open': active }"
	>
		<div class="main-links-inner d-flex align-items-start align-items-lg-center justify-content-between justify-content-lg-start">
			<a :href="urlForOppositeLocale" class="item d-flex text-uppercase language">
				{{ shortOppositeLanguage }}
			</a>

			<a :href="homeUrl" class="logo d-inline-block d-lg-none">
				<icon icon="logo_mobile"></icon>
			</a>

			<a @click.prevent="toggleMenu" href="#" class="item d-flex text-uppercase menu">
				<span class="d-none d-lg-inline">{{ menuText }}</span>

				<button type="button"
						class="hamburger hamburger--squeeze"
						:class="{ 'is-active': active }"
				>
					<span class="hamburger-box">
						<span class="hamburger-inner"></span>
					</span>
				</button>
			</a>
		</div>
	</div>
</template>

<script>

	import Icon from 'laravel-mix-vue-svgicon/IconComponent.vue';

	export default {
		props: [
			'homeUrl',
			'urlForOppositeLocale',
			'shortOppositeLanguage',
			'menuText',
		],

		components: {
			Icon
		},

		data: function() {
			return {
				active: false
			}
		},

		mounted: function() {
			this.closeMenuOnOutsideClick();
		},

		methods: {
			toggleMenu: function() {
				this.active = !this.active;
				eventHub.$emit('menu-toggled', this.active);
			},

			closeMenuOnOutsideClick: function() {
				$(document).on('click', (event) => {
					if (
						this.active &&
						!$(event.target).closest('.hidden-links-container').length &&
						!$(event.target).closest('.main-links').length &&
						!$(event.target).hasClass('.main-links')
					) {
						this.toggleMenu();
					}
				});
			}
		}
	}
</script>