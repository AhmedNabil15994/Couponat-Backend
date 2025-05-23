<?php

namespace Modules\Order\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
           'id'            => $this->id,
           'title'         => $this->title,
           'success_status'=> $this->success_status,
           'failed_status' => $this->failed_status,
           'label_color'   => $this->label_color,
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y', strtotime($this->created_at)),
       ];
    }
}
