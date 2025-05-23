<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Modules\Notification\Repositories\Dashboard\NotificationRepository as Notification;
use Modules\Notification\Traits\SendNotificationTrait as SendNotification;
use Modules\Offer\Entities\Offer;

class SendScheduledNotifications extends Command
{
    use SendNotification;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:notifications';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for sending notifications to customers.';

    /**
     * Execute the console command.
     *
     * @return int
     */

    public $notification;

    public function __construct(Notification $notification)
    {
        parent::__construct();
        $this->notification = $notification;
    }

    public function handle()
    {
        $notifications = $this->notification->getNotifications();
        $devices = $this->notification->getAllFcmTokens();
        foreach ($devices as $token) {
            $tokens[] = $token->firebase_token;
            $types[] = $token->device_type;
        }
        if (count($notifications)) {
            foreach ($notifications as $notification) {
                $data = [
                    'title' => isset($notification->getTranslations('title')['en']) ? $notification->getTranslations('title')['en'] : '',
                    'body' => isset($notification->getTranslations('body')['en']) ? $notification->getTranslations('body')['en'] : '',
                ];
                $data['type'] = 'general';
                $data['id'] = null;
                $this->sendFcmNotification($tokens, $types, $data, 'en');
                $notification->is_sent = 1;
                $notification->save();
            }
        }
    }
}
