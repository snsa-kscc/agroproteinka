<template>
	<div class="hidden-links-container" ref="hlc">
		<div class="menu-cover"></div>

		<div class="inner-content position-relative">
			<ul class="d-flex flex-column align-items-center align-items-lg-start top-level-list">

				<slot></slot>

			</ul>

			<div class="info-container d-block d-lg-none">
				<div class="info-section d-flex flex-column align-items-center">
					<div v-if="formsPageUrl" class="block">
						<p>
							<a :href="formsPageUrl" class="d-flex align-items-center justify-content-center cta-button">
								<span class="icon">
									<img src="/img/files.svg" alt="Obrasci"/>
								</span>
								<span class="text-uppercase">
									{{ formsForDownload }}
								</span>
							</a>
						</p>
					</div>

					<div class="block">
						<p class="d-flex align-items-start">
							<a :href="'tel:' + misc.report_contact_number" class="d-flex align-items-center justify-content-center cta-button">
								<span class="icon">
									<img src="/img/phone.svg" alt="Kontakt"/>
								</span>
								<span class="text-uppercase">
									{{ animalDeathReportContact }}
								</span>
							</a>
						</p>

						<p class="text-uppercase">
							<a :href="'tel:' + misc.report_contact_number" class="d-flex align-items-center justify-content-center">
								{{ misc.report_contact }}
							</a>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import SimpleBar from "simplebar";

	export default {
		props: [
			'formsPageUrl',
			'formsForDownload',
			'animalDeathReportContact'
		],

		data: function() {
			return {
				active: false,
				timer: null,
				hlc: null,
				navContainer: null,
				misc: window.misc
			}
		},

		mounted: function() {
			this.hlc = $(this.$refs.hlc);
			this.navContainer = $('.nav-container');
			new SimpleBar($(this.hlc)[0]);

			setTimeout(() => {
				this.setWidth();
			}, 100)

			$(window).on('resize', () => {
				clearTimeout(this.timer);

				this.timer = setTimeout(() => {
					this.setWidth();
				}, 80);
			});
		},

		methods: {
			setWidth: function() {
				const width = $(window).innerWidth() - this.navContainer.offset().left;

				this.hlc.css({
					width: width + 'px'
				});
			},

			toggleActive: function(active) {
				this.active = active;

				if (this.active) {
					this.hlc.stop(true).fadeIn(150);
				} else {
					this.hlc.stop(true).fadeOut(150);
				}
			}
		},

		created: function() {
			eventHub.$on('menu-toggled', this.toggleActive);
		},

		beforeDestroy: function() {
			eventHub.$off('menu-toggled', this.toggleActive);
		}
	}
</script>