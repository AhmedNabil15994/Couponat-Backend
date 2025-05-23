<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Apps\Http\Controllers\Api\ApiController;

use Modules\Offer\Transformers\Api\OfferResource;
use Modules\User\Http\Requests\Api\StoreFavouriteRequest;
use Modules\User\Repositories\Api\UserRepository as User;

class UserFavouritesController extends ApiController
{
    protected $user;

    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function list()
    {
        $favouritesProducts = auth()->user()->offerFavorites()->orderBy('id','DESC')->paginate(15);
        return $this->responsePaginationWithData(OfferResource::collection($favouritesProducts));
    }

    public function toggleFav(StoreFavouriteRequest $request)
    {
        $favourite = $this->user->findFavourite(auth()->user()->id, $request->offer_id);

        if (!$favourite){
            $check = $this->user->createFavourite(auth()->user()->id, $request->offer_id);
        }else{
            $check = $favourite->delete();

            if ($check)
                $data = [
                    "favouritesCount" => auth()->user()->offerFavorites()->count(),
                ];
                return $this->response($data, __('user::frontend.favourites.index.alert.delete'));
        }

        if ($check) {
            $data = [
                "favouritesCount" => auth()->user()->offerFavorites()->count(),
            ];
            return $this->response($data, __('user::frontend.favourites.index.alert.success'));
        }

        return $this->error(__('user::frontend.favourites.index.alert.error'));
    }


}
