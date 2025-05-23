<?php

namespace Modules\User\Repositories\Frontend;

use DB;
use Hash;
use Modules\Offer\Entities\Offer;
use Modules\User\Entities\Favorite  as Model;

class FavoriteRepository
{
    public function __construct(Model $model)
    {
        $this->model   = $model;
    }


    public function toggleToCurrentUser($user, $id)
    {
        return $user?->offerFavorites()?->toggle($id);
    }
}
