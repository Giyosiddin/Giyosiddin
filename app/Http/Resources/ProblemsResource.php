<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProblemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->problem_id,
            'profession' => new SimpleTableResource($this->problem->profession),
            'details_of_eclipse' => $this->problem->details_of_eclipse,
            'cost' => $this->problem->cost,
            'image' => '/storage/problems/'.$this->problem->image,
            'created_at' => $this->problem->created_at,
        ];
    }
}
