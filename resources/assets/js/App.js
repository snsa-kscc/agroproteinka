
require('./bootstrap/libraries.js');
import ComponentManager from "./services/ComponentManager";

Vue.use(VueCookie);

window.eventHub = new Vue();

const componentManager = new ComponentManager();
componentManager.registerComponents();

const app = new Vue({

	el: '#wrap',

	mounted() {
		this.$nextTick(() => {
			this.setAnimations();
		});
	},

	methods: {
		setAnimations() {
			setTimeout(() => {
				const comp = this;

				$('.animated:not(.header-animation)').appear(function() {
					comp.animateCallback($(this));
				});

				const fullWidthHeaderContainer = $('.full-width-header-image-container');
				const headerWithTextContainer = $('.header-with-text-image-container');

				if (fullWidthHeaderContainer.length) {
					fullWidthHeaderContainer.imagesLoaded({ background: true }, function() {
						$('.animated.header-animation').appear(function() {
							comp.animateCallback($(this));
						});
					});
				}

				if (headerWithTextContainer.length) {
					headerWithTextContainer.imagesLoaded(function() {
						$('.animated.header-animation').appear(function() {
							comp.animateCallback($(this));
						});
					});
				}

			}, 2);
		},

		animateCallback: function(elem) {
			let animation = elem.attr('data-animation');

			if (!elem.hasClass('visible')) {
				let animationDelay = elem.attr('data-animation-delay');

				if (animationDelay) {
					setTimeout(function () {
						elem.addClass(animation + " visible");
					}, animationDelay);
				} else {
					elem.addClass(animation + " visible");
				}
			}
		}
	}

});