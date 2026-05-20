<template>
	<div>
		<section class="section-gray slider-container news-slider" :class="sliderClasses">

			<div class="container-fluid narrow-container wide-title">
				<h2>{{ sliderTitle }}</h2>
			</div>

			<div class="container-fluid narrow-title">
				<div class="row">
					<div class="col-12 d-flex justify-content-end">
						<div class="offset-container">
							<h2>{{ sliderTitle }}</h2>
						</div>
					</div>
				</div>
			</div>

			<div class="container-fluid narrow-container position-relative d-flex justify-content-start justify-content-lg-center">
				<div class="news-carousel-container position-relative">
					<div class="nav-container left-control-container h-100 d-flex align-items-end">
						<div class="nav-arrow nav-arrow-left position-relative"
							 @click.prevent="prev"
						>
							<img src="/img/slider/news-arrow-left-background.svg" alt="Move left" />
							<img src="/img/slider/slider-arrow-left.svg" class="arrow-img" alt="Move left" />
						</div>
					</div>

					<div class="nav-container right-control-container h-100 d-flex flex-column">
						<div class="nav-arrow nav-arrow-right position-relative d-flex justify-content-end"
							 @click.prevent="next"
						>
							<img src="/img/slider/news-arrow-right-background.svg" alt="Move right" />
							<img src="/img/slider/slider-arrow-right.svg" class="arrow-img" alt="Move right" />
						</div>

						<div class="archive-container">
							<div class="title text-uppercase">
								{{ archive }}
							</div>
							<ul>
								<li v-for="year in years">
									<a href="#" @click.prevent="scrollToYear(year)">{{ year }}</a>
								</li>
							</ul>
						</div>
					</div>

					<div class="row news-carousel owl-carousel" ref="sliderNews">

						<div class="single-news col"
							 v-for="newsItem in newsItems"
							 @click="openNewsItem(newsItem)"
						>
							<div class="news-date text-uppercase">
								{{ newsItem.formatted_date }}
							</div>
							<p>
								{{ newsItem.intro }}
							</p>
						</div>

					</div>
				</div>

			</div>

		</section>

		<transition
			v-if="selectedNews"
			name="news-fade"
			mode="out-in"
			appear
			appear-class="news-appear"
			appear-active-class="news-appear-active"
		>
			<single-news-item
				:key="'single-news-item-' + selectedNews.id"
				:selected-news="selectedNews"
			>
			</single-news-item>
		</transition>

	</div>
</template>

<script>

	import TranslationMixin from "../mixins/TranslationMixin";

	export default {
		mixins: [TranslationMixin],

		props: [
			'sectionCls',
			'sliderTitle',
			'newsItems',
			'initialNewsItem',
			'archive'
		],

		data: function() {
			return {
				carousel: null,
				nextEnabled: true,
				prevEnabled: true,
				years: [],
				itemYearMap: {},
				selectedNews: null
			}
		},

		mounted: function() {
			this.setYearsAndYearMap();

			this.$nextTick(() => {
				this.setupSlider();

				if (this.initialNewsItem) {
					setTimeout(() => {
						this.openNewsItem(this.initialNewsItem);
					}, 300)
				}
			})
		},

		methods: {
			openNewsItem: function(newsItem) {
				this.selectedNews = newsItem;

				setTimeout(() => {
					$('html, body').animate({
						scrollTop: $('.section-single-news').offset().top - 100
					}, 300);
				}, 150);
			},

			scrollToYear: function(year) {
				this.carousel.trigger('to.owl.carousel', this.itemYearMap[year]);
			},

			setYearsAndYearMap: function() {
				for (let [index, newsItem] of Object.entries(this.newsItems)) {
					if (newsItem.year) {
						if (!_.includes(this.years, newsItem.year)) {
							this.years.push(newsItem.year);
						}

						if (!this.itemYearMap[newsItem.year]) {
							this.itemYearMap[newsItem.year] = index;
						}
					}
				}
			},

			setupSlider: function() {
				this.carousel = $(this.$refs.sliderNews).owlCarousel({
					responsive : {
						0 : {
							items: 1,
							slideBy: 1,
						},
						1200 : {
							items: 2,
							slideBy: 2,
						},
						1920 : {
							items: 3,
							slideBy: 3,
						}
					},

					dots: false,
					autoHeight: true,

					onChanged: (event) => {
						this.prevEnabled = event.item.index > 0;

						const windowWidth = $(window).outerWidth();
						let itemsPerSlide = 1;

						if (windowWidth >= 1920) {
							itemsPerSlide = 3;
						} else if (windowWidth >= 1200) {
							itemsPerSlide = 2;
						}

						this.nextEnabled = (event.item.index + itemsPerSlide) < event.item.count;
					}
				});
			},

			prev: function() {
				this.carousel.trigger('prev.owl.carousel');
			},

			next: function() {
				this.carousel.trigger('next.owl.carousel');
			}
		},

		computed: {
			sliderClasses: function() {
				const classes = [];

				if (!this.nextEnabled) {
					classes.push('next-disabled');
				}

				if (!this.prevEnabled) {
					classes.push('prev-disabled');
				}

				return classes;
			}
		}
	}
</script>