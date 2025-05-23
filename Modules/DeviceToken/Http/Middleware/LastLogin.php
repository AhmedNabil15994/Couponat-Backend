<?php

namespace Modules\DeviceToken\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Modules\DeviceToken\Traits\SessionDeviceHandler;

class LastLogin
{
    use SessionDeviceHandler;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
//        $user = auth()->user();
//        $this->guard = $user->getGuardName();
//
//        $check = $this->createToken();
//        if ($check) {
//
//            $check->last_used_at = Carbon::now();
//            $check->save();
//        }

        return $next($request);
    }
}
