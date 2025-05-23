<?php

namespace Modules\Faq\Transformers\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'image' => $this->getFirstMediaUrl('images'),
            'title' => $this->title,
            'description' => $this->description,
            'order' => $this->order,
        ];
    }
}
