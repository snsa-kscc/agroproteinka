<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

	@foreach ($pages as $page)

		@foreach (config('gtcms.settings.entityLocales') as $locale)

			<url>
				<loc>{{ url($page->urlForLocale($locale)) }}</loc>
				<lastmod>{{ $page->updated_at->toAtomString() }}</lastmod>

				@if ($page->depth == 0)
					@if ($loop->iteration == 1)
						<priority>1.0</priority>
					@else
						<priority>0.9</priority>
					@endif
				@else
					<priority>0.5</priority>
				@endif

			</url>

		@endforeach

	@endforeach

</urlset>