<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StandartsResource extends JsonResource
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
            'profession' => $this->profession->name,
            'image' => '/storage/standarts/images/'.$this->image,
            'fault' => $this->fault,
            'what_to_do' => $this->what_to_do,
            'standart' => $this->standart,
        ];
    }
}
