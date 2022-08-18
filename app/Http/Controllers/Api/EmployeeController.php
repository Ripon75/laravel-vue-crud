<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeCollection;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Utility\Util;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::paginate(50);

        $employees = new EmployeeCollection($employees);

        if (count($employees) > 0) {
            return Util::response($employees, 'All employee list', 200);
        } else {
            return Util::error(null, 'No employee forund', 201);
        }
    }


    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'name'          => ['required'],
            'department_id' => ['required'],
            'country_id'    => ['required'],
            'state_id'      => ['required'],
            'city_id'       => ['required']
        ]);
 
        if ($validator->stopOnFirstFailure()->fails()) {
            return Util::error($validator->errors(), 'Validation error', 201);
        }

        $name         = $request->input('name', null);
        $address      = $request->input('address', null);
        $departmentId = $request->input('department_id', null);
        $countryd     = $request->input('country_id', null);
        $stateId      = $request->input('state_id', null);
        $cityId       = $request->input('city_id', null);
        $zipCode      = $request->input('zip_code', null);
        $birthdate    = $request->input('birthdate', null);
        $dateHire     = $request->input('date_hire', null);

        $employeeObj = new Employee();

        $employeeObj->name          = $name;
        $employeeObj->address       = $address;
        $employeeObj->department_id = $departmentId;
        $employeeObj->country_id    = $countryd;
        $employeeObj->state_id      = $stateId;
        $employeeObj->city_id       = $cityId;
        $employeeObj->zip_code      = $zipCode;
        $employeeObj->birthdate     = $birthdate;
        $employeeObj->date_hire     = $dateHire;
        $res = $employeeObj->save();
        if ($res) {
            return Util::response($employeeObj, 'Employee create successfully', 200);
        } else {
            return Util::error(null, 'No country forund', 201);
        }
    }

    public function show($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
