<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
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
            'form' => new SimpleTableResource($this->form),
            'status' => new SimpleTableResource($this->status),
            'test_speed' => new SimpleTableResource($this->test_speed),
            'system' => new SimpleTableResource($this->system),
            'previous_test_id' => $this->previous_test_id,
            'examination_date' => $this->examination_date,
            'test_time' => $this->test_time,
            'customer_name' => $this->customer_name,
            'tester_name' => $this->tester_name,
            'test_address_city' => $this->test_address_city,
            'test_address' => $this->test_address,
            'report_address' => $this->report_address,
            'report_address_city' => $this->report_address_city,
            'customer_full_name' => $this->customer_full_name,
            'opposite_side' => $this->opposite_side,
            'customer_logo' => $this->customer_logo,
            'is_guitar_pick' => $this->is_guitar_pick,
            'is_program' => $this->is_program,
            'vat_in_percent' => $this->vat_in_percent,
            'floor' => $this->floor,
            'technical_floor' => $this->technical_floor,
            'more_systems' => $this->more_systems,
            'number_of_shared_buildings' => $this->number_of_shared_buildings,
            'parking_levels' => $this->parking_levels,
            'roof_levels' => $this->roof_levels,
            'upper_reservoir' => $this->upper_reservoir,
            'bottom_reservoir' => $this->bottom_reservoir,
            'shared_systems_with_additional_buildings' => $this->shared_systems_with_additional_buildings,
            'com_areas_in_test' => $this->com_areas_in_test,
            'exam_comm_areas' => $this->exam_comm_areas,
            'resume' => $this->resume,
            'created_at' => $this->created_at,
            'areas' => AreasResource::collection($this->areas)
        ];
    }
}
