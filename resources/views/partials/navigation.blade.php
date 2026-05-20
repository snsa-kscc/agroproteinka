<div class="top-header">
	<div class="container-fluid narrow-container">
		<div class="inner-header position-relative d-flex justify-content-between align-items-start align-items-lg-center">
			<a href="{{ route('home') }}" class="logo d-none d-lg-flex h-100 align-items-center">
				<img src="/img/logoweb.png" alt="Agroproteinka">
			</a>

			<div class="d-flex justify-content-end h-100 header-links">
				<button-links
					forms-page-url="{{ optional($formsPage)->url }}"
					forms-for-download="{{ trans('web.formsForDownload') }}"
					animal-death-report-contact="{{ trans('web.animalDeathReportContact') }}"
				>
				</button-links>

				<div class="nav-container position-relative">

					<header-links
						home-url="{{ route('home') }}"
						url-for-opposite-locale="{{ $page->urlForOppositeLocale() }}"
						short-opposite-language="{{ trans('web.shortOppositeLanguage') }}"
						menu-text="{{ trans('web.menu') }}"
					>
					</header-links>

					<hidden-links-container
						v-cloak
						forms-page-url="{{ optional($formsPage)->url }}"
						forms-for-download="{{ trans('web.formsForDownload') }}"
						animal-death-report-contact="{{ trans('web.animalDeathReportContact') }}"
					>

						@foreach ($navPages as $navPage)

							<page-link
								{{--:has-subpages="{{ $navPage->orderedPages->count() ? 'true' : 'false' }}"--}}
								:has-subpages="false"
								:is-active="{{ $navPage->isActive($page) ? 'true' : 'false' }}"
								url="{{ $navPage->url }}"
								name="{{ $navPage->trans('name') }}"
							>

								{{--@if ($navPage->orderedPages->count())

									<ul>

										@foreach ($navPage->pages as $subpage)

											<li>
												<a href="{{ $subpage->url }}">{{ $subpage->trans('name') }}</a>
											</li>

										@endforeach

									</ul>

								@endif--}}

							</page-link>

						@endforeach

					</hidden-links-container>

				</div>
			</div>

		</div>
	</div>
</div>