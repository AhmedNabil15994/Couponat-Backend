<?php

namespace Modules\Faq\Transformers\Dashboard;

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
            'title' => $this->title,
            'description'=> $this->description,
            'image' => $this->getFirstMediaUrl('images'),
            'status' => $this->status ? trans('faqs::dashboard.yes') : trans('faqs::dashboard.no'),
            'deleted_at' => $this->deleted_at,
            'created_at' => date('d-m-Y', strtotime($this->created_at)),
        ];
    }
}
