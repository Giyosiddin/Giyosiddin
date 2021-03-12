<?php

namespace App\Http\Resources;

use App\Traits\GlobalLines;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class WeatherDataResource extends JsonResource
{
    use GlobalLines;
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = Carbon::now()->addHours($this->get_diff_time('Asia/Yerevan'));

        return [
            'icon' => $date->format('H') > 21 && $date->format('H') < 4 ? "http://openweathermap.org/img/wn/".$this->icon->code_night."@2x.png" : "http://openweathermap.org/img/wn/".$this->icon->code."@2x.png" ,
            'temperature' => $this->temperature,
            'temp_max' => $this->temp_max,
            'temp_min' => $this->temp_min,
            'pressure' => $this->pressure,
            'humidity' => $this->humidity
        ];
    }
}
