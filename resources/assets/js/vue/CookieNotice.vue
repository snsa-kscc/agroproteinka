<template>
	<div v-if="visible" class="notice-container">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12 d-flex justify-content-end">
					<div class="offset-container d-flex justify-content-between align-items-start align-items-lg-center flex-column flex-lg-row">

						<div class="text-container">
							<span>
								{{ misc.cookie_notice }}
							</span>

							<a href="#" @click.prevent="setAcceptCookie" class="button">
								<img src="/img/accept.svg" alt="Prihvaćam">
								<div class="button-text-container d-flex align-items-center">
									{{ accept }}
								</div>
							</a>
						</div>

						<!--<div v-if="legalNoticePageName" class="legal-container">
							<a :href="legalNoticePageUrl">{{ legalNoticePageName }}</a>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [
			'legalNoticePageName',
			'legalNoticePageUrl',
			'accept'
		],

		data: function() {
			return {
				visible: false,
				misc: window.misc
			}
		},

		mounted: function() {
			this.setInitialVisibility();
		},

		methods: {
			setInitialVisibility: function() {
				this.visible = !this.$cookie.get('cookiesAccepted');
			},

			setAcceptCookie: function() {
				this.$cookie.set('cookiesAccepted', true, { expires: '1Y' });
				this.visible = false;
			}
		},

		computed: {

		}
	}
</script>