<?php

namespace Modules\Notification\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $result = [
            'id' => $this->id,
            'user_id' => $this->user?$this->user->name:'user notification',
            'title' => $this->title,
            'body' => $this->body,
            'send_at'   => $this->send_at,
            'is_sent'   => $this->is_sent ? __('notification::dashboard.notifications.form.yes') :  __('notification::dashboard.notifications.form.no'),
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];


        $result['model'] = __('notification::dashboard.notifications.form.notification_type.general');

        return $result;
    }
}
