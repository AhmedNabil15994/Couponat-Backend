<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Frontend\ResetPasswordRequest;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository as AuthenticationRepo;
use Modules\User\Entities\PasswordReset;

class ResetPasswordController extends Controller
{
    use Authentication;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function resetPassword(Request $request, $token)
    {
        $user = PasswordReset::where('token',$token)->first();
        if(!$user){
            abort(404);
        }
        $email = $user->email;
        return view('authentication::frontend.passwords.reset', compact('email', 'token','request'));
    }


    public function updatePassword(ResetPasswordRequest $request)
    {

        $reset = $this->auth->resetPassword($request);

        $errors =  $this->login($request);

        if ($errors) {
            return redirect()->back()->withErrors($errors)->withInput($request->except('password'));
        }

        return redirect()->route('frontend.home')->with(['status' => 'Password Reset Successfully']);
    }
}
