<?php

namespace App\Services;

class DefaultSectionHelper
{
	protected $iteration;
	protected $pageSection;
	protected $previousSectionBackground;
	protected $page;

	public function isHistory()
	{
		return $this->pageSection->type == 'history';
	}

	public function sectionClass()
	{
		$classes = [
			'section-' . $this->pageSection->type,
			$this->forFullWidthHeader() ? 'for-full-width-header' : 'for-header-with-text'
		];

		if ($this->forHeaderWithText()) {
			if ($this->iteration == 1) {
				$classes[] = 'first';
			}

			return implode(' ', $classes);
		}

		$classes[] = $this->sectionBackgroundClass();

		if ($this->imageIsLeft()) {
			$classes[] = 'extra-padding';
		}

		if ($this->isHistory()) {
			$classes[] = 'history-section';
		}

		return implode(' ', $classes);
	}

	protected function sectionBackgroundClass()
	{
		// Fake previous background color, so our "next", i.e. first
		// section background color is always white
		if (!$this->previousSectionBackground) {
			$this->previousSectionBackground = 'section-gray';
		}

		if ($this->pageSection->type == 'history') {
			$this->previousSectionBackground = 'section-white';

			return 'section-white';
		}

		$currentSectionBackground = $this->previousSectionBackground == 'section-white' ? 'section-gray' : 'section-white';
		$this->previousSectionBackground = $currentSectionBackground;

		return $currentSectionBackground;
	}

	public function rowClass()
	{
		if ($this->imageIsRight()) {
			return 'flex-column-reverse flex-lg-row';
		}

		return '';
	}

	public function leftImageColumnWidth()
	{
		if ($this->forHeaderWithText() && $this->imageIsLeft()) {
			return 5;
		}

		return 6;
	}

	public function textContainerClass()
	{
		if ($this->forHeaderWithText()) {
			if ($this->hasRightContent()) {
				return 'right-text';
			}

			return '';
		}

		if ($this->pageSection->type == 'imageText') {
			return 'narrower';
		}

		if ($this->pageSection->type == 'textText') {
			return 'narrow';
		}

		return '';
	}

	public function shouldBeTruncated()
	{
		if ($this->forFullWidthHeader() && !$this->hasOrderForm()) {
			return 1;
		}

		return 0;
	}

	public function animateTextMargin()
	{
		return $this->pageSection->render_option == 'animateTextMargin';
	}

	public function contentContainerClass()
	{
		return in_array($this->pageSection->type, ['imageText', 'imageOrderForm']) ? '' : 'big-indent';
	}

	public function leftContentContainerClass()
	{
		return ($this->pageSection->type == 'textText') ? 'double-text-left' : '';
	}

	public function imagePositionClass()
	{
		if ($this->forHeaderWithText()) {
			if ($this->imageIsLeft()) {
				return 'pull-left-image';
			}

			if ($this->imageIsRight()) {
				return 'pull-right-image';
			}
		}

		if ($this->imageIsLeft()) {
			return 'd-block d-lg-flex justify-content-md-end position-above-top';
		}

		if ($this->imageIsRight()) {
			$classes = ['position-text-line'];

			if ($this->pageSection->image_render_option == 'pullUp') {
				$classes[] = 'position-above-top-extra';
			}

			return implode(' ', $classes);
		}

		return '';
	}

	public function imageMaskClass()
	{
		// Full Width Header section
		if ($this->forFullWidthHeader()) {
			return 'skew-right';
		}

		// Header With Text section
		if ($this->imageIsRight()) {
			return 'right-trapezoid';
		}

		return 'left-trapezoid';
	}

	public function imageAnimationClass()
	{
		return $this->imageIsRight() ? 'fadeInRight' : 'fadeInLeft';
	}

	public function imageFolder()
	{
		// Full Width Header section
		if ($this->forFullWidthHeader()) {
			return 'default';
		}

		// Header With Text section
		if ($this->imageIsRight()) {
			return 'rightTrapezoid';
		}

		return 'leftTrapezoid';
	}

	public function titleClass()
	{
		return $this->forHeaderWithText() ? 'with-dash distant-dash' : '';
	}

	public function fullWidthTitle()
	{
		return $this->pageSection->type == 'textText';
	}

	public function containedTitle()
	{
		return !$this->fullWidthTitle();
	}

	public function imageIsLeft()
	{
		return in_array($this->pageSection->type, ['imageText', 'imageOrderForm']);
	}

	public function imageIsRight()
	{
		return in_array($this->pageSection->type, ['textImage', 'orderFormImage']);
	}

	public function hasLeftContent()
	{
		return in_array($this->pageSection->type, ['textImage', 'textText', 'orderFormImage']);
	}

	public function getLeftText()
	{
		return $this->pageSection->trans('content_1');
	}

	public function hasRightContent()
	{
		return in_array($this->pageSection->type, ['imageText', 'textText', 'imageOrderForm']);
	}

	public function hasFullWidthContent()
	{
		return in_array($this->pageSection->type, ['text']);
	}

	public function getRightText()
	{
		$textProperty = $this->pageSection->type == 'textText' ? 'content_2' : 'content_1';

		return $this->pageSection->trans($textProperty);
	}

	public function hasOrderForm()
	{
		return in_array($this->pageSection->type, ['orderFormImage', 'imageOrderForm']);
	}

	public function hasLeftBackgroundImage()
	{
		return $this->forHeaderWithText() && $this->hasLeftContent();
	}

	public function forHeaderWithText()
	{
		return $this->page->model_key == 'headerWithText';
	}

	public function forFullWidthHeader()
	{
		return $this->page->model_key == 'fullWidthHeader';
	}

	public function setPageSection($pageSection)
	{
		$this->pageSection = $pageSection;

		return $this;
    }

	public function setPage($page)
	{
		$this->page = $page;

		return $this;
    }

	public function setIteration($iteration)
	{
		$this->iteration = $iteration;

		return $this;
    }
}