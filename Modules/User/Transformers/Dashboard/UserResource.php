<?php

namespace Modules\User\Transformers\Dashboard;

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
           'is_verified'    => $this->is_verified,
           'created_at'    => date('d-m-Y' , strtotime($this->created_at)),
       ];
    }
}
