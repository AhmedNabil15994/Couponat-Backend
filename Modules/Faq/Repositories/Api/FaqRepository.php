<?php

namespace Modules\Faq\Repositories\Api;

use Modules\Faq\Entities\Faq;

class FaqRepository
{
    private $faq;
    public function __construct(Faq $faq)
    {
        $this->faq = $faq;
    }

    public function getAll($request,$order = 'id', $sort = 'desc')
    {
        return $this->faq->active()->Published()->orderBy($order, $sort)->get();
    }
}
