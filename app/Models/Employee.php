<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'department_id',
        'country_id',
        'state_id',
        'city_id',
        'zip_code',
        'birthdate',
        'date_hired'
    ];

    protected $casts = [
        'name'          => 'string',
        'address'       => 'string',
        'department_id' => 'integer',
        'country_id'    => 'integer',
        'state_id'      => 'integer',
        'city_id'       => 'integer',
        'zip_code'      => 'string',
        'birthdate'     => 'date',
        'date_hired'    => 'date',
        'created_at'    => 'datetime:Y-m-d H:i:s',
        'updated_at'    => 'datetime:Y-m-d H:i:s'
    ];
}
