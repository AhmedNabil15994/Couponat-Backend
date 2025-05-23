<?php

namespace Modules\Authentication\Repositories\Frontend;

use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Modules\User\Entities\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Modules\User\Entities\PasswordReset;
use Modules\Core\Packages\SMS\SmsBox;

class AuthenticationRepository
{
    protected $password;
    protected $user;
    protected $sms;

    public function __construct(User $user, PasswordReset $password, SmsBox $sms)
    {
        $this->password = $password;
        $this->user = $user;
        $this->sms  = $sms;
    }

    public function register($request)
    {
        DB::beginTransaction();

        try {
            $user = $this->user->create($request);
            $result = $this->resendCode($user);
            if($result){
                DB::commit();
            }
            return [
                'result'    => $result,
                'user'      => $user,
            ];
        } catch (\Exception $e) {
            DB::rollback();
            
            throw $e;
        }
    }

    public function findUserByEmail($request)
    {
        $user = $this->user->where('email', $request->email)->first();
        return $user;
    }

    public function createToken($request)
    {
        $user = $this->findUserByEmail($request);

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));

        $token = $this->password->insert([
            'email' => $user->email,
            'token' => $newToken,
            'created_at' => Carbon::now(),
        ]);

        $data = [
            'token' => $newToken,
            'user' => $user
        ];

        return $data;
    }

    public function resetPassword($request)
    {
        $user = $this->findUserByEmail($request);
        $user->update([
            'password' => Hash::make($request->password)
        ]);
        $this->deleteTokens($user);
        return true;
    }

    public function deleteTokens($user)
    {
        $this->password->where('email', $user->email)->delete();
    }

    public function resendCode($user)
    {
        if (!config("app.have_sms")) {
            abort(503);
        }

        $user->update([
            "code_verified" =>generateRandomCode(4),
            "verification_expire_at" => Carbon::now()->addMinutes(15)->toDateTimeString(),
        ]);

        return $this->sendSms($user);
    }

    public function sendSms($user)
    {
        if(env('APP_ENV') == 'local'){
            return true;
        }
        $result = $this->sms->send($user->code_verified, $user->getPhone());
        return $result["Result"] == "true";
    }
}
