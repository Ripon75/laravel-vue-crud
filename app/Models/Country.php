<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_code',
        'name'
    ];

    protected $casts = [
        'country_code' => 'string',
        'name'         => 'string',
        'created_at'   => 'datetime:Y-m-d H:i:s',
        'updated_at'   => 'datetime:Y-m-d H:i:s'
    ];

    public function states()
    {
        return $this->hasMany(State::class);
    }
}
