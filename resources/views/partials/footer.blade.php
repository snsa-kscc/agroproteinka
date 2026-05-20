<footer class="d-flex align-items-center {{ $page->no_footer_margin ? 'no-footer-margin' : '' }}">
    <div class="container-fluid">
		<div class="row">
			<div class="col-12 d-flex justify-content-end">
				<div class="offset-container">

					<div class="d-flex flex-column flex-lg-row justify-content-between footer-info top-info">
						<div class="d-flex flex-column flex-lg-row left-section">
							<div class="left-info">
								{!! $misc['footer_info_left'] !!}
							</div>
							<div class="right-info">
								{!! $misc['footer_info_right'] !!}
							</div>
						</div>
						<div class="ml-lg-auto right-section">
							<h3>{{ trans('web.legalTerms') }}</h3>
							<ul>

								@foreach ($legalPages as $legalPage)

									<li>
										<a href="{{ $legalPage->url }}">
											{{ $legalPage->trans('name') }}
										</a>
									</li>

								@endforeach

							</ul>
						</div>
					</div>

					<div class="d-flex flex-column flex-lg-row flex-column-reverse justify-content-between footer-info bottom-info">
						<div class="d-flex flex-column flex-lg-row left-section">
							<div class="left-info">
								<img src="/img/logo_footer.png" alt="logo" class="footer-logo position-relative">
							</div>
							<div class="right-info">
								{{ trans('web.allRightsReserved') }}.
							</div>
						</div>
						<div class="ml-lg-auto right-section social position-relative">

							@if ($misc['twitter_link'])

								<a href="{{ $misc['twitter_link'] }}" target="_blank">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 17.2 14.9" style="enable-background:new 0 0 17.2 14.9;" xml:space="preserve">
									<path style="fill:#FFFFFF;" d="M5.4,14.9c6.5,0,10-5.7,10-10.7c0-0.2,0-0.3,0-0.5c0.7-0.5,1.3-1.2,1.8-1.9c-0.6,0.3-1.3,0.5-2,0.6
										c0.7-0.5,1.3-1.2,1.6-2.1C16,0.7,15.3,1,14.5,1.2c-1.3-1.5-3.6-1.6-5-0.2c-0.9,0.9-1.3,2.3-1,3.6C5.6,4.5,3,3,1.2,0.7
										c-0.9,1.7-0.5,3.9,1.1,5c-0.6,0-1.1-0.2-1.6-0.5v0c0,1.8,1.2,3.3,2.8,3.7C3,9.1,2.5,9.1,1.9,9c0.5,1.5,1.8,2.6,3.3,2.6
										c-1.2,1-2.8,1.6-4.4,1.6c-0.3,0-0.6,0-0.8-0.1C1.6,14.3,3.5,14.9,5.4,14.9"/>
									</svg>
								</a>

							@endif

							@if ($misc['linked_in_link'])

								<a href="{{ $misc['linked_in_link'] }}" target="_blank">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 17.2 17" style="enable-background:new 0 0 17.2 17;" xml:space="preserve">
									<path style="fill:#FFFFFF;" d="M17.2,17h-3.3v-6c0-1.6-0.7-2.5-2-2.5c-1.4,0-2.2,0.9-2.2,2.5v6H6.4V5.9h3.3v1.2c0,0,1-1.9,3.4-1.9
										c2.3,0,4.1,1.5,4.1,4.5C17.2,12.9,17.2,17,17.2,17z M1.6,3.2C0.7,3.2,0,2.5,0,1.6C0,0.7,0.7,0,1.6,0c0.9,0,1.6,0.7,1.6,1.6
										C3.2,2.5,2.5,3.2,1.6,3.2z M0,17h3.2V6.4H0V17z"/>
									</svg>
								</a>

							@endif

							@if ($misc['google_link'])

								<a href="{{ $misc['google_link'] }}" target="_blank">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 15 14.9" style="enable-background:new 0 0 15 14.9;" xml:space="preserve">
									<path style="fill:#FFFFFF;" d="M14.9,6H7.7c0,0.7,0,2.2,0,3h4.2c-0.2,0.7-0.7,1.8-1.5,2.3l0,0c-1.1,0.7-2.5,0.9-3.5,0.6
										c-1.6-0.3-2.9-1.5-3.5-3c0,0,0,0,0,0C3,7.9,3,6.7,3.3,6c0.4-1.4,1.8-2.6,3.4-3c1.3-0.3,2.8,0,3.9,1c0.1-0.1,2-2,2.2-2.1
										c-3.7-3.4-9.7-2.2-12,2.2c0,0,0,0,0,0c-1.1,2.1-1.1,4.6,0,6.7c0,0,0,0,0,0c1,1.9,2.7,3.3,4.9,3.8c2.3,0.6,5.1,0.2,7.1-1.5l0,0
										C14.4,11.6,15.4,9.1,14.9,6z"/>
									</svg>
								</a>

							@endif

							@if ($misc['facebook_link'])

								<a href="{{ $misc['facebook_link'] }}" target="_blank">
									<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 viewBox="0 0 8.6 15.9" style="enable-background:new 0 0 8.6 15.9;" xml:space="preserve">
									<path style="fill:#FFFFFF;" d="M5.9,15.9V8.8h2.3l0.4-3.2H5.9V4c0-0.8,0-1.6,1.3-1.6h1.3V0.1c0,0-1.1-0.1-2.2-0.1
										C3.9,0,2.5,1.3,2.5,3.7v1.8H0v3.2h2.5v7.2H5.9z"/>
									</svg>
								</a>

							@endif

							<a href="http://ward.hr/index.html" class="footer-link" target="_blank">Design by Ward</a>

						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<cookie-notice
		legal-notice-page-name="{{ optional($privacyPolicyPage)->trans('name') }}"
		legal-notice-page-url="{{ optional($privacyPolicyPage)->url }}"
		accept="{{ trans('web.accept') }}"
	>
	</cookie-notice>

	<gdpr-notice></gdpr-notice>

	@if (app()->environment() == 'production')

		{{--<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-43283531-1', 'agroproteinka.hr');
			ga('set', 'anonymizeIp', true);
			ga('send', 'pageview');
		</script>--}}

	@endif

</footer>