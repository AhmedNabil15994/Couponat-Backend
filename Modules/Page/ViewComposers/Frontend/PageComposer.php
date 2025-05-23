<?php

namespace Modules\Page\ViewComposers\Frontend;

use Modules\Page\Repositories\Dashboard\PageRepository as Page;
use Illuminate\View\View;
use Cache;

class PageComposer
{
    public $pages = [];

    public function __construct(Page $page)
    {
        $this->pages['aboutUs'] =  $page->findById(setting('other', 'about_us'));
        $this->pages['privacyPolicy'] =  $page->findById(setting('other', 'privacy_policy'));
        $this->pages['terms'] =  $page->findById(setting('other', 'terms'));
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('pages', $this->pages);
    }
}
