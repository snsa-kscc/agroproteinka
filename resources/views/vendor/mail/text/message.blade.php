@component('mail::layout')
	{{-- Header --}}
	@slot('header')
		@component('mail::header', ['url' => route('default')])
			Agroproteinka
		@endcomponent
	@endslot

	{{-- Body --}}
	{{ $slot }}

	{{-- Subcopy --}}
	@isset($subcopy)
		@slot('subcopy')
			@component('mail::subcopy')
				{{ $subcopy }}
			@endcomponent
		@endslot
	@endisset

	{{-- Footer --}}
	@slot('footer')
		@component('mail::footer')
			© {{ date('Y') }} Agroproteinka d.d.
		@endcomponent
	@endslot
@endcomponent
