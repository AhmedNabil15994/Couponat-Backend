<?php

namespace Modules\Page\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Page\Entities\Page;

class PageRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Page::class);
    }
}
