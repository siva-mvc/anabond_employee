<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Response;
use Session;
use App\Employee;
use App\EmployeeFactor;
use App\PerformanceFactor;

class EmployeeFactorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update_employee_performance($employee_id)
    {
      $employee_factors = EmployeeFactor::where('employee_id', $employee_id)->get();
      $factors = PerformanceFactor:: all();

      return view('performance-factor/index', ['employee_factors' => $employee_factors, 'factors' => $factors]);
    }
    
    public function employee_factors_management($employee_id)
    {
        $employee = DB::table('employees')
        ->leftJoin('city', 'employees.city_id', '=', 'city.id')
        ->leftJoin('department', 'employees.department_id', '=', 'department.id')
        ->leftJoin('state', 'employees.state_id', '=', 'state.id')
        ->leftJoin('country', 'employees.country_id', '=', 'country.id')
        ->leftJoin('designation', 'employees.designation_id', '=', 'designation.id')
        ->select('employees.*', 'department.name as department_name', 'department.id as department_id', 'designation.name as designation_name', 'designation.id as designation_id')
        ->where('employees.id', '=' , $employee_id)
        ->get();

        if ($employee == null || count($employee) == 0) {
            return redirect()->intended('/employee-management');
        }
        
        $factors = PerformanceFactor::where('department_id', $employee[0]->department_id)->get();
        $emp_factors = EmployeeFactor::where('employee_id', $employee_id)->get();

        return view('performance-factor/employee_factors_management',['employee' => $employee[0], 'factors' => $factors, 'emp_factors'=>$emp_factors]);
    }

    public function save_employee_factors_management(Request $request, $employee_id)
    {
        $data = $request->all();
        $factors = $data['factors'];
        $targets = $data['targets'];
        if (array_sum($targets) == 50){
            foreach ($factors as $key=>$f) {
                $model_meta = array('employee_id' =>$employee_id, 'performance_factor_id' =>$f, 'target' => $targets[$f], 'order_by' => $key);
                EmployeeFactor::create($model_meta);  
            }    
            return redirect()->intended('/employee-management');
        }else{
            Session::flash('message', 'Sum of targets should be equal to 50'); 
            Session::flash('alert-class', 'alert-danger');
            return Redirect::back()->withInput();        
        }
    }

    public function employee_factor_achivement()
    { 
        return view('performance-factor/employee_factor_achivement');
    }

    public function employee_factor_achivement_month()
    {
        return view('performance-factor/employee_factor_achivement_month');
    }

    public function employee_factor_achivement_year()
    {
        return view('performance-factor/employee_factor_achivement_year');
    }
  

}
