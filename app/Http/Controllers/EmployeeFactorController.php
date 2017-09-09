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
use App\Team;
use App\Department;

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
    
    public function employee_factors_management(Request $request, $employee_id, $year)
    {
        //$year = (isset($request['year'])) ? $request['year'] : date("Y");
        $employee = DB::table('employees')
         ->leftJoin('department', 'employees.department_id', '=', 'department.id')
         ->leftJoin('team', 'employees.team_id', '=', 'team.id')
        ->leftJoin('designation', 'employees.designation_id', '=', 'designation.id')
        ->select('employees.*', 'department.name as department_name', 'department.id as department_id', 'designation.name as designation_name', 'designation.id as designation_id')
        ->where('employees.id', '=' , $employee_id)
        ->get();

        if ($employee == null || count($employee) == 0) {
            return redirect()->intended('/employee-management');
        }
        
        $raw_factors = PerformanceFactor::where('department_id', $employee[0]->department_id)->get();
        $where = array('employee_id' => $employee_id, 'year' => $year);
        $emp_factors = EmployeeFactor::where($where)->get();

        $emp_factor_id_with_score = array();

        foreach ($emp_factors as $f) {
            $emp_factor_id_with_score[$f['performance_factor_id']] = $f['target']; 
        }

        $factors = array();

        foreach ($raw_factors as $fact) {
            if(array_key_exists($fact['id'], $emp_factor_id_with_score)){
                $fact["is_selected"] = True;
                $fact["target"] = $emp_factor_id_with_score[$fact['id']];
                array_push($factors, $fact);
            }else{
                $fact["is_selected"] = False;
                $fact["target"] = 0;
                array_push($factors, $fact);
            }
        }
        return view('performance-factor/employee_factors_management',['year' =>$year, 'employee' => $employee[0], 'factors' => $factors, 'emp_factors'=>$emp_factors]);
    }

    public function save_employee_factors_management(Request $request, $employee_id)
    {
        $data = $request->all();
        if(isset($data['factors'])){
            $factors = $data['factors'];
            $targets = $data['targets'];
            if (array_sum($targets) == 50){
                $where = array('employee_id' => $employee_id, 'year'=> $data['year']);
                EmployeeFactor::where($where)->delete();

                foreach ($factors as $key=>$f) {
                    $model_meta = array('employee_id' =>$employee_id, 'performance_factor_id' =>$f,
                     'target' => $targets[$f], 'year' =>$data['year'], 'order_by' => $key);
                    EmployeeFactor::create($model_meta);  
                }    
                return redirect()->intended('/employee-management');
            }else{
                Session::flash('message', 'Sum of targets should be equal to 50'); 
                Session::flash('alert-class', 'alert-danger');
                return Redirect::back()->withInput();        
            }
        }else{
             Session::flash('message', 'Invalid factor'); 
                Session::flash('alert-class', 'alert-danger');
                return Redirect::back()->withInput();
        }    
    }

    
    public function employee_factors_update_credit(Request $request, $dept_id, $year)
    { 
        $department = Department::find($dept_id);

        $available_factors = PerformanceFactor::where('department_id', $dept_id)->get();

        if ($department == null || count($department) == 0) {
            $available_factors = PerformanceFactor:: all();
        }

        $employee_with_target = DB::table('employee_factor')
         ->leftJoin('employees', 'employee_factor.employee_id', '=', 'employees.id')
         ->leftJoin('performance_factor', 'employee_factor.performance_factor_id', '=', 'performance_factor.id')
        ->select('employee_factor.*', 'employees.firstname as employee_fname', 'employees.lastname as employee_lname', 'performance_factor.name as factor_name')
        ->where('employee_factor.year', '=' , $year)
        ->get();  

        $cons_requet = array();
        foreach ($available_factors as $fact) {
            $list_of_targets = array();
            foreach ($employee_with_target as $key => $val) {
                if($fact['id'] == $val->performance_factor_id){
                    array_push($list_of_targets, $val);
                }
            }
            array_push($cons_requet, array("factor"=>$fact, "user_factor" =>$list_of_targets));
        }  

        $month_array = array(4,5,6,7,8,9,10,11,12,1,2,3);

        return view('performance-factor/employee_factors_update_credit', ['months' =>$month_array, "lists" => $cons_requet]);
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
