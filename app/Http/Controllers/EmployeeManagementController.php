<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Response;
use App\Employee;
use App\City;
use App\State;
use App\Country;
use App\Department;
use App\Designation;
use App\Team;
use App\EmployeeFactor;
use App\EmployeeFactorAchivement;
use App\PerformanceSheet;

class EmployeeManagementController extends Controller
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
    public function index()
    {
        $employees = DB::table('employees')
        ->leftJoin('department', 'employees.department_id', '=', 'department.id')
        ->leftJoin('team', 'employees.team_id', '=', 'team.id')
        ->leftJoin('designation', 'employees.designation_id', '=', 'designation.id')
        ->select('employees.*', 'department.name as department_name', 'department.id as department_id', 'designation.name as designation_name', 'designation.id as designation_id')
        ->orderBy('employees.firstname', 'ASC')
        ->paginate(5);

        $year = (isset($request['year'])) ? $request['year'] : date("Y");
        return view('employees-mgmt/index', ['employees' => $employees, 'year' => $year]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all()->sortBy("name");
        $departments = Department::all()->sortBy("name");
        $designations = Designation::all()->sortBy("name");
        return view('employees-mgmt/create', ['teams' => $teams,
        'departments' => $departments, 'designations' => $designations]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateInput($request);
        $keys = ['employee_reg_id','lastname', 'firstname', 'birthdate', 'date_hired', 'team_id', 'department_id', 'designation_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }
        
        $input['company_id'] = 0;
        $emp = Employee::create($input);
        $year = (isset($request['year'])) ? $request['year'] : date("Y");

        return Redirect::route('employee_factor.factors_management', array($emp->id, $year))->with('message', 'Employee created successfully');
        //return redirect()->intended('/employee-management', []);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        // Redirect to state list if updating state wasn't existed
        if ($employee == null || count($employee) == 0) {
            return redirect()->intended('/employee-management');
        }
        // $cities = City::all()->sortBy("name");
        // $states = State::all()->sortBy("name");
        $teams = Team::all()->sortBy("name");
        $departments = Department::all()->sortBy("name");
        $designations = Designation::all()->sortBy("name");
        return view('employees-mgmt/edit', ['employee' => $employee,'teams' => $teams,
        'departments' => $departments, 'designations' => $designations]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        if ($employee->employee_reg_id != $request['employee_reg_id']) {
            $this->validateInput($request);  
        }else{
            $this->validateInputEdit($request);
        }
        if($employee['department_id'] != $request['department_id']){
            EmployeeFactor::where('employee_id', $id)->delete();
            EmployeeFactorAchivement::where('employee_id', $id)->delete();
            PerformanceSheet::where('employee_id', $id)->delete();
        }
        // Upload image
        $keys = ['employee_reg_id','lastname', 'firstname', 'team_id', 'birthdate', 'date_hired', 'department_id', 'designation_id'];
        $input = $this->createQueryInput($keys, $request);
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        Employee::where('id', $id)
            ->update($input);

        $year = (isset($request['year'])) ? $request['year'] : date("Y");
            
        return Redirect::route('employee_factor.factors_management', array($id,  $year))->with('message', 'Employee updated successfully');   

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employee::where('id', $id)->delete();
        EmployeeFactor::where('employee_id', $id)->delete();
        EmployeeFactorAchivement::where('employee_id', $id)->delete();
        PerformanceSheet::where('employee_id', $id)->delete();
        return redirect()->intended('/employee-management');
    }

    /**
     * Search state from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'firstname' => $request['firstname'],
            'department.name' => $request['department_name']
            ];
        $employees = $this->doSearchingQuery($constraints);
        $constraints['department_name'] = $request['department_name'];
        $year = (isset($request['year'])) ? $request['year'] : date("Y");
        return view('employees-mgmt/index', ['employees' => $employees, 'searchingVals' => $constraints,'year' => $year]);
    }

    private function doSearchingQuery($constraints) {
        $query = DB::table('employees')
        ->leftJoin('department', 'employees.department_id', '=', 'department.id')
        ->leftJoin('team', 'employees.team_id', '=', 'team.id')
        ->leftJoin('designation', 'employees.designation_id', '=', 'designation.id')
        ->select('employees.firstname as employee_name', 'employees.*','department.name as department_name', 'department.id as department_id', 'designation.name as designation_name', 'designation.id as designation_id');
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where($fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }

     /**
     * Load image resource.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function load($name) {
         $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }

    private function validateInput($request) {
        $this->validate($request, [
            'employee_reg_id' => 'required|max:60|unique:employees',
            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            // 'zip' => 'numeric',
            // 'age' => 'numeric',
            'department_id' => 'required',
            'designation_id' => 'required'
        ]);
    }
    private function validateInputEdit($request) {
        $this->validate($request, [
            'employee_reg_id' => 'required|max:60',
            'lastname' => 'required|max:60',
            'firstname' => 'required|max:60',
            // 'zip' => 'numeric',
            // 'age' => 'numeric',
            'department_id' => 'required',
            'designation_id' => 'required'
        ]);
    }

    private function createQueryInput($keys, $request) {
        $queryInput = [];
        for($i = 0; $i < sizeof($keys); $i++) {
            $key = $keys[$i];
            $queryInput[$key] = $request[$key];
        }

        return $queryInput;
    }
}
