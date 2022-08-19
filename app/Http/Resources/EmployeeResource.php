<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'address'       => $this->address,
            'department_id' => $this->department_id,
            'department'    => $this->department,
            'country_id'    => $this->country_id,
            'country'       => $this->country,
            'state_id'      => $this->state_id,
            'state'         => $this->state,
            'city_id'       => $this->city_id,
            'city'          => $this->city,
            'zip_code'      => $this->zip_code,
            'birthdate'     => $this->birthdate,
            'date_hire'     => $this->date_hire
        ];
    }
}