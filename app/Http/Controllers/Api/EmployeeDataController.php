<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Utility\Util;

class EmployeeDataController extends Controller
{
    public function country()
    {
        $countries = Country::get();
        if ($countries) {
            return Util::response($countries, 'All country', 200);
        } else {
            return Util::error(null, 'No country forund', 201);
        }
    }

    public function state(Country $country)
    {
        $country = Country::with(['states'])();
        $states = $country->states;
        
        return response()->json($states);
    }
}
