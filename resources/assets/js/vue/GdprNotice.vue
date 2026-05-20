<template>
	<div v-if="visible" class="gdpr-notice-container d-flex justify-content-center align-items-center">
		<div class="gdpr-notice position-relative">
			<a href="#" class="close-gdpr" @click.prevent="setGdprNoticeRead">
				<img src="/img/close.svg" alt="Zatvori" />
			</a>

			<h2>GDPR</h2>

			<div v-html="misc.gdpr_notice"></div>
		</div>
	</div>
</template>

<script>
	export default {
		props: [

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
				this.visible = !this.$cookie.get('gdprNoticeRead');
			},

			setGdprNoticeRead: function() {
				this.$cookie.set('gdprNoticeRead', true, { expires: '1Y' });
				this.visible = false;
			}
		},

		computed: {

		}
	}
</script>