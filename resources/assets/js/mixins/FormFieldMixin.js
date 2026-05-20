
var FormFieldMixin = {

	props: [
		'name',
		'placeholder',
		'formErrors'
	],

	data: function() {
		return {
			isField: true,
			value: null,
			errorMessage: null
		}
	},

	mounted: function() {

	},

	watch: {
		formErrors: function() {
			this.setErrorMessage();
		},

		value: function() {
			this.clearErrorMessage();
		}
	},

	methods: {
		setErrorMessage: function() {
			this.errorMessage = this.formErrors?.[this.name]?.[0] || null;
		},

		clearErrorMessage: function() {
			this.$emit('clear-form-error', this.name)
			this.errorMessage = null;
		},

		getPropertyAndValue: function() {
			return {
				[this.name]: this.getValue()
			}
		},

		getValue: function() {
			return this.value;
		},

		setValue: function(value) {
			this.value = value;
		}
	},

	computed: {
		id: function() {
			return 'field-' + this.name;
		}
	}

}

export default FormFieldMixin;

