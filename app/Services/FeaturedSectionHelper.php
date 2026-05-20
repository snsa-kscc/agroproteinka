<?php

namespace App\Services;

class FeaturedSectionHelper
{
	protected $iteration;

	public function rowClass()
	{
		if ($this->imagePosition() == 'right') {
			return 'flex-column-reverse flex-lg-row';
		}

		return '';
	}

	public function textContainerClass()
	{
		if ($this->textIsRight()) {
			return 'narrow';
		}

		return '';
	}

	public function contentContainerClass()
	{
		if ($this->textIsRight()) {
			return 'medium-indent';
		}

		return 'big-indent';
	}

	public function outerContentContainerClass()
	{
		if ($this->textIsRight()) {
			return 'd-flex justify-content-md-end';
		}

		return '';
	}

	public function sectionClass()
	{
		$classes = ['for-full-width-header'];

		if ($this->iteration % 2 == 0) {
			$classes[] = 'section-gray';
		}

		if ($this->iteration % 3 == 2 || $this->iteration % 3 == 0) {
			$classes[] = 'extra-padding';
		}

		return implode(' ', $classes);
	}

	public function imagePositionClass()
	{
		if ($this->iteration % 3 == 1) {
			return 'position-text-line';
		}

		if ($this->iteration % 3 == 0) {
			return 'position-above-top';
		}

		return '';
	}

	public function imagePosition()
	{
		return $this->textIsLeft() ? 'right' : 'left';
	}

	public function textIsLeft()
	{
		return $this->iteration % 2 != 0;
	}

	public function textIsRight()
	{
		return !$this->textIsLeft();
	}

	public function setIteration($iteration)
	{
		$this->iteration = $iteration;

		return $this;
    }
}