<?php

namespace Modules\Authentication\Http\Controllers\Api;

use Illuminate\Http\Request;
use Modules\Authentication\Http\Requests\Api\ResendCodeRequest;
use Modules\Authentication\Http\Requests\Api\VerifiedCodeRequest;
use Modules\Authentication\Repositories\Api\AuthenticationRepository;
use Modules\User\Entities\User;
use Modules\User\Transformers\Api\UserResource;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Api\LoginRequest;

class LoginController extends ApiController
{
    use Authentication;

    protected $user;

    public function __construct(AuthenticationRepository $user)
    {
        $this->user = $user;
    }

    public function postLogin(LoginRequest $request)
    {
        $user = User::where('mobile', $request->email)->orwhere('email',$request->email)->first();
//        if($user->code_verified){
//            return $this->tokenResponse($request,$user);
//        }
        $failedAuth = $this->login($request,'api');

        if ($failedAuth){
            return $this->invalidData($failedAuth, [], 422);
        }
        return $this->tokenResponse($request,$user);
//        $result = $this->user->resendCode($user);
//        if($result){
//            return $this->tokenResponse($request,$user);
//        }else{
//            return $this->error(__('authentication::api.register.messages.failed'), [], 401);
//        }
    }

    public function tokenResponse($request,$user = null)
    {
        $user = $user ?? auth()->user();
        $token = $this->generateToken($request,$user);
        return $this->response([
            'access_token' => $token->plainTextToken,
            'user' => new UserResource($user),
            'token_type' => 'Bearer',
            'expires_at' => date('Y-m-d',strtotime('+2 months'))
        ]);
    }

    public function logout(Request $request)
    {
        $this->tokenExpiresAt();
        return $this->response([], __('authentication::api.logout.messages.success'));
    }

}
