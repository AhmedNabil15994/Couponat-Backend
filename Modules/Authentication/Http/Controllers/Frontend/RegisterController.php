<?php

namespace Modules\Authentication\Http\Controllers\Frontend;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Area\Entities\Country;
use Modules\Authentication\Http\Requests\Frontend\VerifyOtpRequest;
use Modules\User\Entities\User;
use PragmaRX\Countries\Package\Countries;
use Modules\Authentication\Mail\WelcomeMail;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Http\Requests\Frontend\RegisterRequest;
use Modules\Authentication\Notifications\Frontend\WelcomeNotification;
use Modules\Authentication\Repositories\Frontend\AuthenticationRepository as AuthenticationRepo;
use Modules\Cart\Traits\CartTrait;

class RegisterController extends Controller
{
    use Authentication;
    use CartTrait;

    protected $auth;

    public function __construct(AuthenticationRepo $auth)
    {
        $this->auth = $auth;
    }

    public function show(Request $request)
    {
        return view('authentication::frontend.register', compact('request'));
    }

    public function register(RegisterRequest $request)
    {

        $validator = validator()->make(
            request()->all(),
            ['captcha' => 'required|captcha'],
            [
                'captcha.captcha'   => __('user::api.users.validation.captcha.captcha'),
                'captcha.required'   => __('user::api.users.validation.captcha.required'),
            ]
        );
        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
        try {
            $registered = $this->auth->register($request->validated());
            if ($registered['result']) {
                return [
                    'success'   => true,
                    'user'   => $registered['user'],
                ];
            } 
            throw \Illuminate\Validation\ValidationException::withMessages([
                'mobile' => __("authentication::api.register.messages.error_sms_mobile"),
            ]);
        } catch (Exception $ex) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'mobile' => $ex->getMessage(),
            ]);
        }
    
    }

    public function redirectTo($request)
    {
        return redirect()->route('frontend.home');
    }

    public function verifyCode(VerifyOtpRequest $request)
    {
        $code = $request->code;
        $user = User::find($request->user_id);
        if(!$user) {
            return [
                'success' => false,
                'message'     => __('authentication::frontend.verification.invalid_user'),
            ];
        }

        if($user->code_verified && $code != $user->code_verified) {
            return [
                'success' => false,
                'message'     => __('authentication::frontend.verification.invalid_code'),
            ];
        }

        auth()->login($user);

        $user->update([
            "code_verified" => null,
            "verification_expire_at" => null,
        ]);

        $redirectRoute = 'frontend.home';
        $token = request()->has('user_token') ? request()->get('user_token') : session()->get('user_token');
        if($token) {
            $redirectRoute = 'frontend.cart.index';
            $this->updateCartKey($token, auth()->id());
            session()->forget(['user_token']);
        }

        return [
            'success' => true,
            'message'     => __('authentication::frontend.verification.login_success'),
            'url'     => $redirectRoute ? route($redirectRoute) : '',
        ];
    }

    public function countries()
    {
        $countries = Country::pluck('title', 'id');

        return $countries;
    }

}
