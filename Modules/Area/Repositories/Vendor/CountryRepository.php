<?php

namespace Modules\Area\Repositories\Vendor;

use Modules\Area\Entities\Country;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class CountryRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(Country::class);
    }
}
