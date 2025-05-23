<?php

namespace Modules\User\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
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
           'name'          => $this->name,
           'email'         => $this->email,
           'mobile'        => $this->mobile,
           'image'         => $this->getFirstMediaUrl('images'),
            'roles'          => implode(',',$this->roles()->pluck('name')->toArray()),
            'calling_code'         => $this->calling_code,
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
