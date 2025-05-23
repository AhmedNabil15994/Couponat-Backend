<?php

namespace Modules\Area\Repositories\Vendor;

use Modules\Area\Entities\Area;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class AreaRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Area::class);
    }
}
