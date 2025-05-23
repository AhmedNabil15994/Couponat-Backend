<?php

namespace Modules\Catalog\Transformers\Dashboard;

use Illuminate\Http\Resources\Json\JsonResource;
use IlluminateAgnostic\Collection\Support\Carbon;

class AcademicYearResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'status' => $this->status,
            'created_at' => Carbon::parse($this->created_at)->toDateString(),
        ];
    }
}
