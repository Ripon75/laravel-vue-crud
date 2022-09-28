<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Country;
use App\Models\State;
use App\UtilClass\CommonUtils;

class EmployeeDataController extends Controller
{
    public function country()
    {
        $countries = Country::get();
        if (count($countries) > 0) {
            return CommonUtils::response($countries, 'All country', 200);
        } else {
            return CommonUtils::error(null, 'No country forund', 201);
        }
    }

    public function state(Country $country)
    {
        $states = $country->states;
        
         if (count($states) > 0) {
            return CommonUtils::response($states, 'All state', 200);
        } else {
            return CommonUtils::error(null, 'No state forund', 201);
        }
    }

    public function city(State $state)
    {
        $cities = $state->cities;
        
         if (count($cities) > 0) {
            return CommonUtils::response($cities, 'All state', 200);
        } else {
            return CommonUtils::error(null, 'No state forund', 201);
        }
    }

    public function department()
    {
        $departments = Department::get();

        if (count($departments) > 0) {
            return CommonUtils::response($departments, 'All department', 200);
        } else {
            return CommonUtils::error(null, 'No departmenr forund', 201);
        }
    }
}
