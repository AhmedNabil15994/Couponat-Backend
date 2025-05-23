<?php

namespace Modules\Area\Repositories\Vendor;

use Modules\Area\Entities\City;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class CityRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(City::class);
    }
}
