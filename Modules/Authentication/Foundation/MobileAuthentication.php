<?php

namespace Modules\Authentication\Foundation;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Authentication\Entities\OtpRequest;
use Modules\User\Entities\User;

trait MobileAuthentication
{
    public function loginOrRegister($email, $loginType = 'frontend')
    {
        $user =  User::where('email',$email)->first();

        if($user){
            $route = 'frontend.home';
        }else{

            $user = User::create(['email' => $email,'first_login' => 1]);
            $user->refresh();
            $route = 'frontend.profile.edit';
        }

        switch($loginType){
            case 'frontend':
                $this->frontLogin($user);
        }

        return $this->loginReponse($user,$route);
    }

    public function loginReponse($user,$route){

        return $route;
    }

    public function frontLogin($user){

        Auth::login($user);
    }
}
