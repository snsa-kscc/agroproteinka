<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\GetsHomepageData;
use App\Models\NewsItem;
use App\Services\TranslationHelper;
use GTCrais\LFB\Services\MetaManager;
use Illuminate\Http\Request;

class NewsController extends Controller
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

	public function show(Request $request, $slug)
	{
		$initialNewsItem = $newsItems = NewsItem::published()
			->where('slug', $slug)
			->with('orderedImages')
			->firstOrFail();

		[$page, $data] = $this->getHomepageData($this->pageClass, $initialNewsItem);

		$this->metaManager->setItem($initialNewsItem);
		$data['localePrefix'] = $this->translationHelper->localePrefix(app()->getLocale());

		return view()->make('pages.' . $page->viewKey)->with($data);
    }
}
