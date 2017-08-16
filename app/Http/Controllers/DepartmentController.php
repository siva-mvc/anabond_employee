<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Employee;

class DepartmentController extends Controller
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
        $departments = DB::table('department')
        ->leftJoin('employees', 'department.employee_id', '=', 'employees.id')
        ->select('department.id', 'department.name', 'employees.firstname as employee_name', 'employees.id as employee_id')
        ->paginate(5);

        return view('system-mgmt/department/index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = Employee::all();
        return view('system-mgmt/department/create', ['employees' => $employees]);
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
         Department::create([
            'name' => $request['name'],
            'employee_id' => $request['employee_id']
        ]);

        return redirect()->intended('system-management/department');
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
        $department = Department::find($id);
        // Redirect to department list if updating department wasn't existed
        if ($department == null || count($department) == 0) {
            return redirect()->intended('/system-management/department');
        }

        $employees = Employee::all();
        return view('system-mgmt/department/edit', ['department' => $department, 'employees' => $employees]);
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
        $department = Department::findOrFail($id);

        if ($department->name != $request['name']) {
            $this->validateInput($request);  
        }
        $input = [
            'name' => $request['name'],
            'employee_id' => $request['employee_id']
        ];
        Department::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/department');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Department::where('id', $id)->delete();
         return redirect()->intended('system-management/department');
    }

    /**
     * Search department from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $departments = $this->doSearchingQuery($constraints);
       return view('system-mgmt/department/index', ['departments' => $departments, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = department::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( $fields[$index], 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(5);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:department'
    ]);
    }
}
