<?php

namespace Modules\User\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\User\Transformers\Api\UserResource;
use Modules\User\Http\Requests\Api\UpdateProfileRequest;
use Modules\User\Http\Requests\Api\ChangePasswordRequest;
use Modules\User\Repositories\Api\UserRepository as User;
use Modules\Apps\Http\Controllers\Api\ApiController;

class CompanyController extends ApiController
{
    function __construct(User $user)
    {
        $this->user = $user;
    }

    public function profile()
    {
        $user =  $this->user->userProfile();
        return $this->response(new UserResource($user));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $this->user->updateCompany($request);

        $user =  $this->user->userProfile();

        return $this->response(new UserResource($user));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->user->changePassword($request);

        $user =  $this->user->findById(auth()->id());

        return $this->response(new UserResource($user));
    }
}
