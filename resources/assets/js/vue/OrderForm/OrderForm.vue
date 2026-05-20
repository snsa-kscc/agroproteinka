<template>
	<form @submit.prevent="submitForm" class="order-form">

		<form-field-text
			name="company"
			:placeholder="this.translations.company"
			:form-errors="formErrors"
		>
		</form-field-text>

		<form-field-text
			name="address"
			:placeholder="this.translations.address"
			:form-errors="formErrors"
		></form-field-text>

		<form-field-text
			name="contactPerson"
			:placeholder="this.translations.contactPerson"
			:form-errors="formErrors"
		></form-field-text>

		<form-field-text
			name="contactPhone"
			:placeholder="this.translations.contactPhone"
			:form-errors="formErrors"
		></form-field-text>

		<form-field-textarea
			name="note"
			:placeholder="this.translations.note"
			:form-errors="formErrors"
		></form-field-textarea>

		<form-field-checkbox
			name="terms"
			:form-errors="formErrors"
		></form-field-checkbox>

		<div v-if="submit.showMessage"
			 class="submit-message"
			 :class="submitMessageClass"
		>
			{{ submit.isError ? submit.errorMessage : submit.successMessage }}
		</div>

		<button
			v-if="!submit.complete"
			type="submit"
			class="btn btn-submit px-3"
			:class="{'disabled': formIsSubmitting}"
			@click.prevent="submitForm"
		>
			{{ translations.submit }}
		</button>

	</form>
</template>

<script>
	export default {
		props: [
			'translations'
		],

		data: function() {
			return {
				formIsSubmitting: false,
				formErrors: {},
				submit: {
					successMessage: this.translations.submissionSuccessful,
					errorMessage: this.translations.defaultErrorMessage,
					showMessage: false,
					isError: false,
					complete: false
				}
			}
		},

		mounted: function() {
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
		},

		methods: {
			submitForm: function() {
				if (this.formIsSubmitting || this.submit.complete) {
					return;
				}

				this.formIsSubmitting = true;
				this.clearFormErrors();

				let comp = this;

				$.ajax({
					type: 'POST',
					url: localePrefix + 'submit-order',
					data: comp.composeSubmitData(),
					success: function(data) {
						comp.submit.complete = true;
						comp.submit.showMessage = true;
						comp.resetFormFields();
					},
					error: function(jqXHR, error, errorThrown) {
						if (jqXHR.status === 422) {
							comp.formErrors = jqXHR.responseJSON.errors;
						} else {
							comp.submit.isError = true;
							comp.submit.showMessage = true;
						}
					},
					complete: function() {
						comp.formIsSubmitting = false;
					}
				});

			},

			composeSubmitData: function() {
				let data = {};

				for (let formField of this.formFields) {
					data = Object.assign(data, formField.getPropertyAndValue());
				}

				return data;
			},

			clearFormErrors: function() {
				this.formErrors = {};
				this.submit.showMessage = false;
				this.submit.isError = false;
			},

			resetFormFields: function() {
				for (let formField of this.formFields) {
					formField.setValue(null);
				}
			}
		},

		computed: {
			formFields: function() {
				return _.filter(this.$children, ['isField', true]);
			},

			submitMessageClass: function() {
				return this.submit.isError ? 'is-error' : '';
			}
		}
	}
</script>