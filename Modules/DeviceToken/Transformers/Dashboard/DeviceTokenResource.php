<?php

namespace Modules\DeviceToken\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceTokenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $last_login = $this->last_used;
        return [
            'id' => $this->id,
            'name' => $this->name,
            'user' => optional($this->tokenable)->name,
            'os' => $this->os,
            'abilities' => $this->abilities,
            'last_used' => $last_login->label .' '.$last_login->time,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
