<template>

	<div class="form-group is-checkbox" :class="{ 'has-error': errorMessage }">
		<div class="icheck-material-white">
			<input type="checkbox"
				   :name="name"
				   :id="id"
				   value="1"
				   v-model="checked"
			>

			<label :for="id">You must accept terms of service</label>
		</div>
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
				checked: false
			}
		},

		mounted: function() {

		},

		methods: {
			getValue: function() {
				return this.checked ? 1 : 0;
			},

			setValue: function(value) {
				this.checked = !!value;
			}
		},

		computed: {

		}
	}
</script>