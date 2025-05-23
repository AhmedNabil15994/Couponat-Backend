<?php

namespace Modules\Area\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class CityResource extends JsonResource
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
           'title'         => $this->translate(locale())->title,
           'status'        => $this->status,
           'states'        => StateResource::collection($this->whenLoaded('states')),
       ];
    }
}
