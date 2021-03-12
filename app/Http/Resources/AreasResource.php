<?php

namespace App\Http\Resources;

use App\Problems;
use Illuminate\Http\Resources\Json\JsonResource;

class AreasResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->area->name,
            'created_at' => $this->created_at,
            'problems' => ProblemsResource::collection($this->problems)
        ];
    }
}
