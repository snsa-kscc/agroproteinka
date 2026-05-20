<template>
	<div class="button-links d-none d-lg-flex align-items-center">
		<div class="button-link report"
			 @mouseenter="expand('report')"
			 @mouseleave="shrink('report')"
			 ref="report"
		>
			<div class="content position-relative">
				<span class="icon">
					<img src="/img/phone.svg" alt="phone">
				</span>
				<span class="text">
					{{ animalDeathReportContact }} - {{ misc.report_contact }}
				</span>
			</div>
		</div>

		<a class="button-link forms"
		   :href="formsPageUrl"
		   v-if="formsPageUrl"
		   @mouseenter="expand('forms')"
		   @mouseleave="shrink('forms')"
		   ref="forms"
		>
			<div class="content position-relative">
				<span class="icon">
					<img src="/img/forms.svg" alt="forms">
				</span>
				<span class="text">
					{{ formsForDownload }}
				</span>
			</div>
		</a>
	</div>
</template>

<script>
	export default {
		props: [
			'formsPageUrl',
			'formsForDownload',
			'animalDeathReportContact'
		],

		data: function() {
			return {
				misc: window.misc,
				report: null,
				forms: null
			}
		},

		mounted: function() {
			this.report = $(this.$refs.report);
			this.forms = $(this.$refs.forms);
		},

		methods: {
			expand(button)
			{
				let textWidth = parseInt(this[button].find('.text').width()) + 70;
				this[button].css('width', textWidth + 'px').addClass('expanded');
			},

			shrink(button)
			{
				this[button].css('width', '48px').removeClass('expanded');
			}
		},

		computed: {

		}
	}
</script>