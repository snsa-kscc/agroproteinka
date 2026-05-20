<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GetsHomepageData;
use App\Models\HistoryItem;
use App\Models\Page;
use App\Services\DefaultSectionHelper;
use App\Services\TranslationHelper;
use GTCrais\LFB\Services\MetaManager;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PageController extends Controller
{
	use GetsHomepageData;

	protected $metaManager;
	protected $pageClass;
	/**
	 * @var TranslationHelper
	 */
	protected $translationHelper;

	public function __construct(MetaManager $metaManager, TranslationHelper $translationHelper)
	{
		$this->metaManager = $metaManager;
		$this->pageClass = config('lfb.pageClass');
		$this->translationHelper = $translationHelper;
	}

	/**
	 * @param Request $request
	 * @param string $slug
	 *
	 * @return View
	 * @throws \Exception
	 */
	public function show(Request $request, $slug = "")
	{
		$pageClass = $this->pageClass;
		$initialNewsItem = null;

		if (!$slug) {
			[$page, $data] = $this->getHomepageData($this->pageClass);
		} else {
			$slugString = 'slug_' . app()->getLocale();
			/** @var Page $page */
			$page = $pageClass::where($slugString, $slug)->with('pageSections')->active()->first();

			$data = [
				'page' => $page,
				'sectionHelper' => new DefaultSectionHelper()
			];

			if (optional($page)->hasHistorySection()) {
				$data['historyItems'] = HistoryItem::active()->orderBy('year')->get();
			}
		}

		if ($page) {
			$this->metaManager->setItem($page);
			$data['localePrefix'] = $this->translationHelper->localePrefix(app()->getLocale());

			return view()->make('pages.' . $page->viewKey)->with($data);
		}

		abort(404);
	}

	public function pageNotFound()
	{
		abort(404);
	}

	public function sitemap(Request $request)
	{
		$pageClass = $this->pageClass;
		$pages = $pageClass::orderBy('depth')->orderBy('position')->get();
		$content = view('layouts.sitemap')->with(compact('pages'));

		return response()->make($content)->header('Content-Type', 'text/xml');
	}
}