<?php

namespace Modules\Authentication\Repositories\Api;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;
use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\Authentication\Foundation\Authentication;
use Modules\Authentication\Notifications\Api\WelcomeNotification;
use Modules\Core\Packages\SMS\SmsBox;
use Modules\Core\Traits\Attachment\Attachment;
use Modules\User\Entities\PasswordReset;
use Modules\User\Entities\User;
use Modules\User\Transformers\Api\UserResource;
use Modules\Cart\Traits\CartTrait;

class AuthenticationRepository extends ApiController
{
    use Authentication,CartTrait;

    private $user;
    private $password;

    protected $sms;

    public function __construct(User $user, PasswordReset $password, SmsBox $sms)
    {
        $this->password = $password;
        $this->user = $user;
        $this->sms  = $sms;
    }

    public function register(Request $request)
    {
        DB::beginTransaction();
        try {
            $user = $this->user->create($request->all());
            $result = $this->resendCode($user);
            if($result){
                DB::commit();
            }
            return [
                'result'    => $result,
                'user'      => $user,
            ];
        } catch (\Exception$e) {
            DB::rollback();
            throw $e;
        }
    }

    public function login(Request $request, $checkClubApp = false)
    {
        try {
            $user = $this->findUserByEmailActive($request, $checkClubApp);

            if ($user && Hash::check($request->password, $user->password)) {
                return ['status' => 1, 'data' => $user];
            }

            $errors = ['status' => 0, 'data' => new MessageBag([
                'password' => __('authentication::api.login.validation.failed'),
            ])];

            return $errors;
        } catch (\Exception$e) {
            throw $e;
        }
    }

    public function UpdatePassword(Request $request)
    {
        try {
            $user = $request->user();

            if (Hash::check($request->old_password, $user->password)) {
                $user->password = Hash::make($request->password);
                $user->save();

                return true;
            }

            return false;
        } catch (\Exception$e) {
            throw $e;
        }
    }

    public function updateProfile(Request $request)
    {
        try {
            $user = $request->user();

            if ($request['password'] == null)
                $password = $user['password'];
            else
                $password  = Hash::make($request['password']);

            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'phone_code'    => '965',
                'first_login'   => 0,
                'password'      => $password,
            ]);

            return $user;
        } catch (\Exception$e) {
            throw $e;
        }
    }

    public function updateAddress(Request $request)
    {
        try {
            $user = $request->user();

            $address = $user->address;

            if($address){
                $address->update([
                    'region' => $request->region ?? null,
                    'type' => $request->address_type ?? null,
                    'street' => $request->street ?? null,
                    'gada' => $request->gada ?? null,
                    'widget' => $request->widget ?? null,
                    'details' => $request->details ?? null,
                ]);
            }else{
                $user->address()->create([
                    'region' => $request->region ?? null,
                    'type' => $request->address_type ?? null,
                    'street' => $request->street ?? null,
                    'gada' => $request->gada ?? null,
                    'widget' => $request->widget ?? null,
                    'details' => $request->details ?? null,
                ]);
            }

            return $user;
        } catch (\Exception$e) {
            throw $e;
        }
    }

    public function findUserByMobile($request)
    {
        $user = $this->user->where([
            ['mobile', $request->mobile],
            ['calling_code', $request->calling_code],
        ])->first();
        return $user;
    }

    public function getAuthUser($request = null)
    {
        return $request ? $request->user() : auth()->user();
    }

    public function findUserByMobileActive($request)
    {
        $user = $this->user->where('mobile', $request->mobile)->active()->first();
        return $user;
    }
    public function findUserByEmailActive($request, $checkClubApp = false)
    {
        $user = $this->user->where('email', $request->email);
        return $user->first();
    }

    public function profileInfo($request)
    {
        $user = $request->user();
        return [
            'user' => new UserResource($user),
        ];
    }

    public function tokenResponse(Request $request, $user = null)
    {
        $user = $user ? $user : $request->user();
        $user->refresh();

        if ($request->user_token)
            $this->updateCartKey($request->user_token,$user->id);

        $token = $this->generateToken($request, $user);

        return $this->response([
            'access_token' => $token->plainTextToken,
            'user' => new UserResource($user),
            'token_type' => 'Bearer',
        ]);
    }

    public function createToken($request)
    {
        $user = $this->findUserByEmailActive($request);

        if (!$user) {
            return false;
        }

        $this->deleteTokens($user);

        $newToken = strtolower(Str::random(64));

        $token = $this->password->insert([
            'email' => $user->email,
            'token' => $newToken,
            'created_at' => Carbon::now(),
        ]);

        $data = [
            'token' => $newToken,
            'user' => $user,
        ];

        return $data;
    }

    public function deleteTokens($user)
    {
        $this->password->where('email', $user->mobile)->delete();
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
