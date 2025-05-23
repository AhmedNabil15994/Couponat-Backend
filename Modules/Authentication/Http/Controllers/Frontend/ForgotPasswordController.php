<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Http\Requests\Frontend\ForgetPasswordRequest;
use Modules\Authentication\Notifications\Frontend\ResetPasswordNotification;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository as Authentication;

class ForgotPasswordController extends Controller
{
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function forgetPassword()
    {
        return view('authentication::frontend.passwords.email');
    }

    public function sendForgetPassword(ForgetPasswordRequest $request)
    {
        $user = $this->auth->findUserByEmail($request);
        $result = $this->auth->resendCode($user);
        return [
            'result'    => $result,
            'user'      => $user,
        ];
    }
}
