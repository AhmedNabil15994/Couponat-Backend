<?php

namespace Modules\Authentication\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Api\RegisterRequest;
use Modules\Authentication\Http\Requests\Api\ResendRequest;
use Modules\Authentication\Http\Requests\Api\VerifyOtpRequest;
use Modules\Authentication\Repositories\Api\AuthenticationRepository as AuthenticationRepo;
use Modules\Cart\Traits\CartTrait;
use Modules\User\Entities\User;
use Modules\User\Transformers\Api\UserResource;

class RegisterController extends ApiController
{
    use Authentication, CartTrait;

    protected $auth;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function register(RegisterRequest $request)
    {
        DB::beginTransaction();
        try {
            $registered = $this->auth->register($request);
            if ($registered['result']) {
                if (isset($request->user_token) && !is_null($request->user_token)) {
                    $this->updateCartKey($request->user_token, $registered['user']->id);
                }

                if (isset($request->newsletter_subscribe) && $request->newsletter_subscribe == 1) {
                    // Send Newsletter Here
                }

                DB::commit();
                return $this->responseData($request,$registered['user']);
            } else {
                return $this->error(__('authentication::api.register.messages.failed'), [], 401);
            }
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function verified(VerifyOtpRequest $request)
    {
        $code = $request->code;
        $user = $this->auth->findUserByMobile($request);
        if(!$user){
            return $this->invalidData( ['mobile' => [__('authentication::frontend.verification.invalid_user')]], [], 401);
        }

        if($user->code_verified && $code != $user->code_verified){
            return $this->invalidData( ['code' => [__('authentication::frontend.verification.invalid_code')]], [], 401);
        }

        auth()->login($user);

        $user->update([
            "is_verified" => true,
            "code_verified" => null,
            "verification_expire_at" => null,
        ]);

        return $this->responseData($request,$user);
    }

    public function resendCode(ResendRequest $request)
    {
        $user = $this->auth->findUserByMobile($request);
        if(!$user){
            return $this->invalidData( ['mobile' => [__('authentication::frontend.verification.invalid_user')]], [], 401);
        }

        $result = $this->auth->resendCode($user);
        return $this->response([
            'sms_sent'  => $result,
            'code'      => env('APP_ENV') == 'local' ?  $user->code_verified : '',
        ]);
    }

    public function responseData($request,$user = null)
    {
        $user = $user ? $user : auth()->user();
        $token = $this->generateToken($request,$user);

        return $this->response([
            'access_token' => $token->plainTextToken,
            'user' => new UserResource($user),
            'token_type' => 'Bearer',
            'expires_at' => date('Y-m-d',strtotime('+2 months'))
        ]);
    }

}
