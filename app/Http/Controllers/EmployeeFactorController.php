<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Response;
use Session;
use App\Employee;
use App\EmployeeFactor;
use App\PerformanceFactor;
use App\Team;
use App\Department;
use App\EmployeeFactorAchivement;
use App\PerformanceSheet;
use App\PerformanceAudit;
use PDF;

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
                $whr = array('employee_id' => $employee_id, 'year'=>$data['year']);
                EmployeeFactorAchivement::where($whr)->delete();
                $delete = PerformanceSheet:: where(array('employee_id'=>$employee_id,'year' => $data['year']))->delete();
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

        $month_array = array(4,5,6,7,8,9,10,11,12,1,2,3, 13, 21, 30,15);

        $department = Department::find($dept_id);

        $total_depts_search = DB::table('department')->whereIn('department.id',Session::get('departments'))->get();



        $available_factors = PerformanceFactor::where('department_id', $dept_id)->get();

        if ($department == null || count($department) == 0) {
            $available_factors = PerformanceFactor:: all();
        }

        $employee_with_target = DB::table('employee_factor')
         ->leftJoin('employees', 'employee_factor.employee_id', '=', 'employees.id')
         ->leftJoin('performance_factor', 'employee_factor.performance_factor_id', '=', 'performance_factor.id')
        ->select('employee_factor.*', 'employees.name as employee_fname', 'employees.lastname as employee_lname', 'performance_factor.name as factor_name')
        ->where('employee_factor.year', '=' , $year)
        ->get();  

        $whr = array('year' => $year, "department_id" => $dept_id);
        if($dept_id == 0){
            $whr = array('year' => $year);    
        }
        
        $achiveds = EmployeeFactorAchivement::where($whr)->get();
        
        $month_array = array(4,5,6,7,8,9,10,11,12,1,2,3, 13, 21, 30,15);
        $cons_requet = array();
        foreach ($available_factors as $fact) {
            $list_of_targets = array();
            foreach ($employee_with_target as $key => $val) {
                if($fact['id'] == $val->performance_factor_id){
                    $root_id = $val->id;
                    $months_wise_achived = array();
                    $months_wise_target = array();
                    foreach ($month_array as $m) {
                        // filter from array
                        $curr_fact = array_filter(iterator_to_array($achiveds), function($obj) use($root_id, $m) {
                        if($obj->month == $m && $obj->employee_factor_id == $root_id ){return true;} else{ return false;}}); 

                        if(sizeof(array_keys($curr_fact)) > 0){
                            $d_key = array_keys($curr_fact)[0];
                                $months_wise_achived[$m] = $curr_fact[$d_key]['achived']; 
                                $months_wise_target[$m] = $curr_fact[$d_key]['target'];
                        }else{
                            $months_wise_achived[$m] = "";
                            $months_wise_target[$m] = "";
                        }        
                    }
                        $val->targets = $months_wise_target;
                        $val->achiveds = $months_wise_achived;
                        
                    array_push($list_of_targets, $val);
                }
            }
            array_push($cons_requet, array("factor"=>$fact, "user_factor" =>$list_of_targets));
        } 

        return view('performance-factor/employee_factors_update_credit', 
            ['months' =>$month_array, "lists" => $cons_requet, "dept_id"=>$dept_id, "year"=>$year, "depts" =>$total_depts_search, "dept_ids"=> Session::get('departments')]);
    }



    
    public function employee_factors_update_achived_credit(Request $request, $dept_id, $year)
    { 
        $data = $request->all();
        $fs = $data['achived'];
        $ft = $data['target'];
        $user = Auth::user();
        $issued_by = $user['email'];
        $used_fators = DB::table('employee_factor')
             ->leftJoin('employees', 'employee_factor.employee_id', '=', 'employees.id')
             ->leftJoin('performance_factor', 'employee_factor.performance_factor_id', '=', 'performance_factor.id')
            ->select('employee_factor.*', 'employees.name as employee_fname', 'employees.lastname as employee_lname','employees.department_id as department_id', 'performance_factor.name as factor_name')
            ->whereIn('employee_factor.id', array_keys($fs))
            ->get();  

        $builk_achived = array();
        if(isset($fs)) {
            foreach ($fs as $k => $v) {
                $curr_fact = array_filter(iterator_to_array($used_fators), function($obj) use($k) {
                if($obj->id == $k){return true;} else{ return false;}}); 
                $d_key = array_keys($curr_fact)[0];
                
                $fac = $curr_fact[$d_key];
                $new_achived_by_user = array(
                    'employee_id' => $fac->employee_id,
                    'employee_factor_id' =>$k,
                    'department_id' => $fac->department_id,
                    'factor_name' => $fac->factor_name,
                    //'target'=> $fac->target,
                    'year' => $fac->year,
                    'issued_by' =>$issued_by
                    );

                foreach ($v as $m => $c) {
                    $achived_by_month = array_merge($new_achived_by_user, array('target' =>$ft[$k][$m],'month'=>$m, 'achived' =>$c));
                    array_push($builk_achived, $achived_by_month);

                }
            }
            $whr = array('department_id' => $dept_id, 'year'=>$year);
            if($dept_id == 0){
                $whr = array('year'=>$year);
            }
            

            EmployeeFactorAchivement::where($whr)->delete();
            EmployeeFactorAchivement::insert($builk_achived);
            //
            //$delete = PerformanceSheet:: where(array('year' => $year))->delete();
            //
            Session::flash('message', 'Credit updated successfull'); 
            Session::flash('alert-class', 'alert-success');
            return Redirect::route('employee_factor.factor_achivement_credit', array($dept_id, $year))->with('message', 'Credit updated successfull');
           }else{
            Session::flash('message', 'Credit updated successfull'); 
            Session::flash('alert-class', 'alert-danger');
            return Redirect::route('employee_factor.factor_achivement_credit', array($dept_id, $year))->withInput();
           }     
    }






    public function employee_perfromance_sheet(Request $request, $emp_id, $year){
        
        $sheet = array('employee_id' => $emp_id, 'year'=>$year, 'total_score' => 0,'experience' =>0, 'future_prospect' => 0,'raw_total' =>0);

        $sht = PerformanceSheet:: where(array('employee_id'=>$emp_id, 'year' => $year))->get();
        $history = PerformanceAudit::where(array('employee_id'=>$emp_id, 'year' => $year))->get();

        $employee = Employee::findOrFail($emp_id);
        
        $requet_content = array();
        $whr = array('employee_target_achivement.year'=>$year, 'employee_target_achivement.employee_id'=>$emp_id);
        $lists = DB::table('employee_target_achivement')
             ->leftJoin('employee_factor', 'employee_target_achivement.employee_factor_id', '=', 'employee_factor.id')
            ->select('employee_target_achivement.*','employee_factor.target as actual_target')
            ->whereIn('employee_target_achivement.month', array(13, 21, 30,15))
            ->whereNotNull('achived')
            ->where($whr)
            ->get();

        $target_list = DB::table('employee_target_achivement')
        ->leftJoin('employee_factor', 'employee_target_achivement.employee_factor_id', '=', 'employee_factor.id')
        ->select('employee_target_achivement.*','employee_factor.target as actual_target')
        ->whereNotIn('employee_target_achivement.month', array(13, 21, 30,15))
        ->whereNotNull('achived')
        ->where($whr)
        ->get();  

        $re_order = array(); 
        foreach ($lists as $l => $value) {
            $re_order[$value->factor_name]['actual_target'] = $value->actual_target;  
            $re_order[$value->factor_name][$value->month] = $value;
        }  
        //new code
        $re_order_target = array();
        foreach ($lists as $l => $value) {
            $re_order_target[$value->factor_name][$value->month] = $value;
            $rating_percent = ($value->achived * 100)/ $value->target;
            $re_order_target[$value->factor_name][$value->month]->rating = round(($rating_percent/100)* $value->actual_target, 2);
        }

        $new_targets = array();
          foreach ($re_order_target as $key => $value) {
            $sum = 0;
            $d = sizeof($value);
            foreach ($value as $k) {
               $sum = $sum +$k->rating;
            }

           $new_targets[$key] = round($sum/$d, 2);
        }
        $total = array_sum($new_targets);   
        
        if (count($sht) > 0) {
            $sheet = $sht[0];
        }else{
            $sheet['total_score'] = $total;
            $sheet['raw_total'] = ($sheet['raw_total'] == 0) ? $total: $sheet['raw_total'];
        }



        return view('performance-factor/employee_perfromance_sheet', 
            ['sheets' =>$re_order, 'targets'=> $new_targets,'employee' => $employee,
             'total' => $total, 'year'=>$year, 'sheet' => $sheet, 'history' =>$history]);
    }


   public function perfromance_sheet_save(Request $request, $emp_id, $year){
        $user = Auth::user();
        $issued_by = $user['email'];
        $firstname = $user['firstname'];
        $data = $request->all();
        if($data['total'] >0){
            $whr = array('employee_id'=>$emp_id, 'year' => $year);
            $ex = PerformanceSheet:: where($whr)->get();
            $psheet  = array('employee_id' => $emp_id, 'year'=>$year, 'total_score' => $data['total'],'experience' => $data['experience'], 'future_prospect' => $data['future_prospect'],'raw_total' =>$data['raw_total'], 'created_by'=>$firstname);
            if(count($ex)>0){
                $update = PerformanceSheet:: where($whr)->update($psheet);
            }else{
                
                $create = PerformanceSheet::create($psheet);
            }    
            $save = PerformanceAudit::create(array('employee_id' => $emp_id, 'year'=>$year, 'total_score' => $data['total'],'experience' => $data['experience'], 'future_prospect' => $data['future_prospect'],'raw_total' =>$data['raw_total'], 'created_by'=>$firstname));

            return Redirect::route('employee_factor.perfromance_sheet', array($emp_id, $year))->with('message', 'Credit updated successfull');
        }else{
            return Redirect::route('employee_factor.perfromance_sheet', array($emp_id, $year))->with('message', 'Unable to process your request!');
        }
    
   }
    
    public function exportList(Request $request, $dept_id){
        $year = (isset($year)) ? $request['year'] : date("Y");

        //$whr = array('performance_sheet.year' => $year);
        $dept_id = (isset($dept_id)) ? $dept_id : Session::get('departments')[0];

        $total_depts_search = DB::table('department')->whereIn('department.id',Session::get('departments'))->get();

        $whr = array('performance_sheet.year' => $year);

        $whrIn = array($dept_id); 
        if($dept_id ==0){
            $whrIn = Session::get('departments');
        }


        $sheets = DB::table('performance_sheet')
            ->rightJoin('employees', 'performance_sheet.employee_id', '=', 'employees.id')
            ->rightJoin('department', 'employees.department_id', '=', 'department.id')
            ->select('performance_sheet.*','employees.name as employee_name','department.name as department_name' )
            ->where($whr)
            ->whereIn('employees.department_id', $whrIn)
            ->get();
        return view('performance-factor/employee_perfromance_sheet_list', 
            ['sheets' =>$sheets, 'dept_id'=>$dept_id, 'depts'=>$total_depts_search, 'year'=>$year]); 

    }

    public function exportPDF(Request $request) {
        $year = (isset($request['year'])) ? $request['year'] : date("Y"); 
        $ids = Session::get('departments');
        if(count($ids)==0){
            $ids =array();    
        }
        if($request['dept_id'] != 0){
            $ids = array($request['dept_id']); 
        }
        $user_list = Employee::whereIn('department_id', $ids)->get();
        $export_data = array(); 

        foreach ($user_list as $key => $emp) {
            $sheet = $this->getExportingData($emp['id'], $year);
            if($sheet){
                array_push($export_data, $sheet);
            }
        }

        $pdf = PDF::loadView('performance-factor/employee_perfromance_sheet-pdf',['sheets' => $export_data]);
        return $pdf->download('report_for_'.$year.'.pdf');
        //return view('performance-factor/employee_perfromance_sheet-pdf', ['sheets' => $export_data]);
    }
    
    private function getExportingData($emp_id, $year) {
        $employee = Employee::findOrFail($emp_id);
        $sheet = PerformanceSheet:: where(array('employee_id'=>$emp_id, 'year' => $year))->get();
        if(count($sheet)>0){
        
            $whr = array('employee_target_achivement.year'=>$year, 'employee_target_achivement.employee_id'=>$emp_id);
            $lists = DB::table('employee_target_achivement')
                 ->leftJoin('employee_factor', 'employee_target_achivement.employee_factor_id', '=', 'employee_factor.id')
                ->select('employee_target_achivement.*','employee_factor.target as actual_target')
                ->whereIn('employee_target_achivement.month', array(13, 21, 30,15))
                ->whereNotNull('achived')
                ->where($whr)
                ->get();

            $target_list = DB::table('employee_target_achivement')
            ->leftJoin('employee_factor', 'employee_target_achivement.employee_factor_id', '=', 'employee_factor.id')
            ->select('employee_target_achivement.*','employee_factor.target as actual_target')
            ->whereNotIn('employee_target_achivement.month', array(13, 21, 30,15))
            ->whereNotNull('achived')
            ->where($whr)
            ->get();  

            $re_order = array(); 
            foreach ($lists as $l => $value) {
                $re_order[$value->factor_name]['actual_target'] = $value->actual_target;  
                $re_order[$value->factor_name][$value->month] = $value;
            }  
            //new code
            $re_order_target = array();
            foreach ($lists as $l => $value) {
                $re_order_target[$value->factor_name][$value->month] = $value;
                $rating_percent = ($value->achived * 100)/ $value->target;
                $re_order_target[$value->factor_name][$value->month]->rating =  round(($rating_percent/100)* $value->actual_target, 2);
            }

            $new_targets = array();
              foreach ($re_order_target as $key => $value) {
                $sum = 0;
                $d = sizeof($value);
                foreach ($value as $k) {
                   $sum = $sum +$k->rating;
                }

               $new_targets[$key] = round($sum/$d, 2);
            }
            $total = array_sum($new_targets);  
            return $result = array('sheets' =>$re_order, 'targets'=> $new_targets,'employee' => $employee,
             'total' => $total,'sheet' => $sheet); 
            }else{
                return false;
            }

       
    }



}
