<?php

namespace Modules\DeviceToken\Http\Controllers\Api;

use Modules\Apps\Http\Controllers\Api\ApiController;
use Modules\DeviceToken\Entities\PersonalAccessToken;
use Modules\Notification\Traits\SendNotificationTrait;
use Modules\User\Entities\FirebaseToken;
use Modules\User\Http\Requests\Api\FCMTokenRequest;
use Modules\User\Transformers\Api\FCMTokenResource;
use Auth;
class FCMTokenController extends ApiController
{
    use SendNotificationTrait;
    public function store(FCMTokenRequest $request)
    {
        $data=$request->all();
        $data['user_id'] = null;
        if($request->bearerToken()){
            $tokenObj = PersonalAccessToken::findToken($request->bearerToken());
            $data['user_id'] = $tokenObj?->tokenable?->id;
        }
        $data['device_type'] = FirebaseToken::DEVICE_TYPES[$request->device_type];

        $firebaseToken=FirebaseToken::updateOrCreate(['firebase_token'=>$data['firebase_token']], $data);
        return $this->response(new FCMTokenResource($firebaseToken));
    }
}
