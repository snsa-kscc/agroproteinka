<template>

	<div class="form-group" :class="{ 'has-error': errorMessage }">
		<textarea
			:name="name"
			class="form-control"
			:id="id"
			:placeholder="placeholder"
			v-model="value"
			@input="clearErrorMessage"
			ref="input"
		></textarea>

		<label class="error" v-if="errorMessage">
			{{ errorMessage }}
		</label>
	</div>

</template>

<script type="text/babel">

	import FormFieldMixin from "../../mixins/FormFieldMixin";

	export default {
		mixins: [FormFieldMixin],

		props: [

		],

		data: function() {
			return {

			}
		},

		mounted: function() {

		},

		methods: {

		},

		computed: {

		}
	}
</script>