
const FormErrorKeysMixin = {

	computed: {

		formErrorKeys: function() {
			return _.map(this.formErrors, (error, key) => { return key });
		}

	}

}

export default FormErrorKeysMixin;

