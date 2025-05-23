<?php

namespace Modules\Area\Repositories\Vendor;

use Modules\Area\Entities\State;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class StateRepository extends CrudRepository
{
    public function __construct()
    {
        parent::__construct(State::class);
    }
}
