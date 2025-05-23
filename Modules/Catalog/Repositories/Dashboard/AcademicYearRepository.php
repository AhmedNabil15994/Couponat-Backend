<?php

namespace Modules\Catalog\Repositories\Dashboard;

use Modules\Catalog\Entities\AcademicYear;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class AcademicYearRepository extends CrudRepository
{
   
    public function __construct($model = null)
    {
        $this->model = new AcademicYear;
    }

}
