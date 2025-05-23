<?php

namespace Modules\DeviceToken\Traits;
use Illuminate\Support\Str;

trait SessionDeviceHandler
{
    protected $guard = 'web';
    protected function getGuard()
    {
        return $this->guard;
    }

    protected function getCookieName($user)
    {
        return 'deviceId'.$this->getGuard().$user->id;
    }

    protected function getTokenWithCookie($user)
    {
        return isset($_COOKIE[$this->getCookieName($user)]) ?
            $user->tokens()->where('name' , $_COOKIE[$this->getCookieName($user)])->first() : null;
    }

    protected function checkGuardIsSession()
    {
        $guard = config('auth.guards.'.$this->getGuard());
        if($guard && $guard['driver'] == 'session')
            return true;

        return false;
    }

    protected function createToken()
    {
        $user = auth($this->getGuard())->user();
        $token = $this->getTokenWithCookie($user);

        if(!$token){

            if(isset($_COOKIE[$this->getCookieName($user)])){
                unset($_COOKIE[$this->getCookieName($user)]);
            }

            $deviceId = $this->generateDeviceId($user);
            setcookie($this->getCookieName($user), $deviceId);
            $token = $user->createToken((object)[],$deviceId);
            $token = $token->accessToken;
        }
        return $token;
    }

    protected function generateDeviceId($user)
    {
        $token = Str::random(40);
        $check = $user->tokens()->where('name' , $token)->first();

        if($check){
            return $this->generateDeviceId($user);
        }else{
            return $token;
        }
    }

    protected function userLogout()
    {
        $user = auth($this->getGuard())->user();
        $this->removeSession($this->getTokenWithCookie($user),$user);
        auth($this->guard)->logout();
    }

    protected function removeSession($model , $user = null)
    {
        $user = $user ??$model->user;

        if(isset($_COOKIE[$this->getCookieName($user)]))
            unset($_COOKIE[$this->getCookieName($user)]);

        if($model)
            $model->delete();
    }
}
