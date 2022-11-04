<?php

namespace App\Http\Controllers\Api;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\UtilClasses\CommonUtils;
use App\Http\Controllers\Controller;
use App\Http\Resources\EmployeeResource;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\EmployeeCollection;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $searchKey = $request->input('search_key', null);
        $paginate  = config('crud.paginate.default');

        $employees = new Employee();

        $employees = $employees->with(['department', 'country', 'state', 'city']);

        if ($searchKey) {
            $employees = $employees->where('name', 'like', "%{$searchKey}%");
        }

        $employees = $employees->paginate($paginate);
        
        // $employees = new EmployeeCollection($employees);

        if (count($employees) > 0) {
            return CommonUtils::response($employees, 'All employee list');
        } else {
            return CommonUtils::error(null, 'No employee forund');
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
            return CommonUtils::error($validator->errors(), 'Validation error', 201);
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
        $employeeObj->date_hired    = $dateHire;
        $res = $employeeObj->save();
        if ($res) {
            return CommonUtils::response($employeeObj, 'Employee create successfully', 200);
        } else {
            return CommonUtils::error(null, 'No country forund', 201);
        }
    }

    public function show(Employee $employee)
    {
        $employe = new EmployeeResource($employee);

        if ($employee) {
            return CommonUtils::response($employe, 'Employee single view', 200);
        } else {
            return CommonUtils::error(null, 'Employee not found', 201);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name'          => ['required'],
            'department_id' => ['required'],
            'country_id'    => ['required'],
            'state_id'      => ['required'],
            'city_id'       => ['required']
        ]);
 
        if ($validator->stopOnFirstFailure()->fails()) {
            return CommonUtils::error($validator->errors(), 'Validation error', 201);
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

        $employee = Employee::find($id);

        $employee->name          = $name;
        $employee->address       = $address;
        $employee->department_id = $departmentId;
        $employee->country_id    = $countryd;
        $employee->state_id      = $stateId;
        $employee->city_id       = $cityId;
        $employee->zip_code      = $zipCode;
        $employee->birthdate     = $birthdate;
        $employee->date_hire     = $dateHire;
        $res = $employee->save();
        if ($res) {
            return CommonUtils::response($employee, 'Employee updated successfully', 200);
        } else {
            return CommonUtils::error(null, 'Employee can not update', 201);
        }
    }

    public function destroy(Employee $employee)
    {
        $res = $employee->delete();

        if ($res) {
            return CommonUtils::response(null, 'Employee deleted successfully', 200);
        } else {
            return CommonUtils::error(null, 'Employee is not deletes', 201);
        }
    }
}
