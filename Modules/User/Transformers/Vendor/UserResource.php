<?php

namespace Modules\User\Transformers\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'calling_code'         => $this->calling_code,
           'image'         => asset($this->image_file),
           'deleted_at'    => $this->deleted_at,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
