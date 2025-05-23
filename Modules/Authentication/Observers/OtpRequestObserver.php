<?php
  
namespace Modules\Authentication\Observers;
  
use IlluminateAgnostic\Collection\Support\Carbon;
use Modules\Authentication\Entities\OtpRequest;
use Modules\Transaction\Services\SMS\SMS;
  
class OtpRequestObserver
{
  
    /**
     * Handle the OtpRequest "created" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function creating(OtpRequest $request)
    {
        $request->otp = env("SMS_BOX_STATUS", '') == 'live' && $request->mobile != '123456789' ? rand(1000,9999) : '1111';
    }
  
    /**
     * Handle the OtpRequest "created" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function created(OtpRequest $request)
    {
        $this->sendOtp($request->mobile, $request->otp);
    }
  
    /**
     * Handle the OtpRequest "updating" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function updating(OtpRequest $request)
    {
        $request->otp = env("SMS_BOX_STATUS", '') == 'live' && $request->mobile != '123456789' ? rand(1000,9999) : '1111';
        $request->updated_at = Carbon::now()->toDateTimeString();
    }
  
    /**
     * Handle the OtpRequest "updated" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function updated(OtpRequest $request)
    {
        $this->sendOtp($request->mobile, $request->otp);
    }

    private  function sendOtp($mobile,$otp)
    {
        env("SMS_BOX_STATUS", '') == 'live' ? (new SMS)->send($mobile, "your verification code is {$otp}") : null;
    }
  
}