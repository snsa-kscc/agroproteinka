
const TranslationMixin = {

	methods: {

		trans: function(object, property) {
			return object[property + '_' + window.locale];
		}

	}

}

export default TranslationMixin;

