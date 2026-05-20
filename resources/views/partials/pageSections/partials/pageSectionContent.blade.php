<div class="col-12 col-lg-6">
	<div class="content-container {{ $sectionHelper->contentContainerClass() }} {{ $contentContainerClass ?? '' }} d-flex justify-content-lg-end">
		<div class="inner-content-container">
			<div class="text-container {{ $sectionHelper->textContainerClass() }}">

				@if ($sectionHelper->containedTitle() && $pageSection->trans('title'))

					<h2 class="{{ $sectionHelper->titleClass() }}">{{ $pageSection->trans('title') }}</h2>

				@endif

				@if ($sectionHelper->hasOrderForm())

					<order-form :translations="{{ json_encode(trans('web.orderForm')) }}"></order-form>

				@else

					<inner-text-container :truncate="{{ $sectionHelper->shouldBeTruncated() }}" :animate-text-margin="{{ $sectionHelper->animateTextMargin() ? 'true' : 'false' }}">
						{!! $text !!}
					</inner-text-container>

				@endif

			</div>
		</div>
	</div>
</div>


