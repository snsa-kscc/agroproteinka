<template>
	<li :class="cssClasses">
		<span v-if="hasSubpages">{{ name }}</span>
		<a v-else :href="url">{{ name }}</a>

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