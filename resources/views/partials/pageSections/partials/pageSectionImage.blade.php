<div class="col-12 col-lg-{{ $sectionHelper->leftImageColumnWidth() }} d-flex justify-content-lg-end align-items-start">
	<div class="section-img-container position-relative {{ $sectionHelper->imagePositionClass() }}">
		<img src="{{ $pageSection->imageUrl($sectionHelper->imageFolder()) }}"
			 alt="Section image"
			 class="section-img masked animated delay-short fast {{ $sectionHelper->imageMaskClass() }}"
			 data-animation="{{ $sectionHelper->imageAnimationClass() }}"
		>
	</div>
</div>


