<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Department;
use App\Employee;
use App\user;

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
        $departments = DB::table('department')->orderBy('name', 'asc')
        ->select('department.*')
        ->paginate(20);

        return view('system-mgmt/department/index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$employees = Employee::all();
        $user=User::orderBy('email', 'asc')->get();
        return view('system-mgmt/department/create', ['user'=>$user]);
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
            'head_of_dept' => $request['head_of_dept'],
            'div_head' => $request['div_head'],
            'director' => $request['director'],
            'branch_head' => $request['branch_head']
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
        $user=User::orderBy('email', 'asc')->get();
        // Redirect to department list if updating department wasn't existed
        if ($department == null || count($department) == 0) {
            return redirect()->intended('/system-management/department');
        }
        $employees = Employee::all();
        return view('system-mgmt/department/edit', ['department' => $department, 'employees' => $employees, 'user'=>$user]);
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
            'head_of_dept' => $request['head_of_dept'],
            'div_head' => $request['div_head'],
            'director' => $request['director'],
            'branch_head' => $request['branch_head'],
            'freeze2017' => $request->has('freeze2017') ? 1 : 0,
            'freeze2018' => $request->has('freeze2018') ? 1 : 0
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
        return $query->paginate(20);
    }
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60|unique:department'
    ]);
    }
}
