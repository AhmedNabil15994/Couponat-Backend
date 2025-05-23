<?php

namespace Modules\User\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'seller'        => $this->seller?->name,
            'calling_code'         => $this->calling_code,
           'image'         => $this->getFirstMediaUrl('images'),
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
