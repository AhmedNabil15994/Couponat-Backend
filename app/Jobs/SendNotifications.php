<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\Notification\Repositories\Dashboard\NotificationRepository as Notification;
use Modules\Notification\Traits\SendNotificationTrait as SendNotification;

class SendNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use SendNotification;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $notifications = $this->notification->getNotifications();
        if(count($notifications)){
            $tokens = $this->notification->getAllFcmTokens();
            foreach ($notifications as $notification){
                if (count($tokens)) {
                    foreach($tokens as $lang => $token){
                        $data = [
                            'title' => isset($notification->getTranslations('title')[$lang]) ? $notification->getTranslations('title')[$lang] : '',
                            'body' => isset($notification->getTranslations('body')[$lang]) ? $notification->getTranslations('body')[$lang] : '',
                        ];
                        $data['type'] = 'general';
                        $data['id'] = null;
                        $this->send($data, (array)$token);
                    }
                }
                $notification->is_sent = 1;
                $notification->save();
            }
        }


    }
}
