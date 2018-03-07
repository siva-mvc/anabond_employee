<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PerformanceFactor;
use App\Department;
use App\EmployeeFactor;
use App\User;

class PerformanceFactorController extends Controller
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
        $factors = DB::table('performance_factor')
        ->Join('department', 'performance_factor.department_id', '=', 'department.id')
        ->select('performance_factor.*', 'department.name as department_name')
        ->orderBy('department.name', 'asc')
        ->orderBy('performance_factor.name', 'asc')
        ->paginate(20);
        
        return view('system-mgmt/factor/index', ['factors' => $factors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departments = Department::orderBy('name', 'asc')->get();
        $user=User::orderBy('email', 'asc')->get();

        return view('system-mgmt/factor/create', ['departments' => $departments,'user'=>$user]);
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
         $check  = PerformanceFactor::where(array('department_id' =>$request['department_id'], 'name' => $request['name']))->get();
        if(count($check)>0){
              $this->validate($request, [
        'name' => 'unique:performance_factor'

    ]);
        }

        else{
         PerformanceFactor::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'description' => $request['description']
            
        ]);
     }

        return redirect('system-management/factor');
    }

    /**
     * Display the specified resource.
     *`
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
        $user=User::orderBy('email', 'asc')->get();
        $departments = Department::orderBy('name', 'asc')->get();
        $factor = PerformanceFactor::find($id);
        // Redirect to factor list if updating factor wasn't existed
        if ($factor == null || count($factor) == 0) {
            return redirect()->intended('/system-management/factor');
        }

        return view('system-mgmt/factor/edit', ['factor' => $factor, 'departments' =>$departments, 'user'=>$user]);
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
        $factor = PerformanceFactor::findOrFail($id);
         if ($factor->name != $request['name']) {
            $this->validateInput($request);  
        }
        
        $check  = PerformanceFactor::where(array('department_id' =>$request['department_id'], 'name' => $request['name']))->get();
        if(count($check) >=1 && $id != $check[0]['id']){
             $this->validateInput($request);
        }
       
        $input = [
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'description' => $request['description'],
            'allowexceed' => $request->has('allowexceed') ? 1 : 0
  
        ];
        PerformanceFactor::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/factor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = EmployeeFactor:: where('performance_factor_id',$id)->get();
        if(count($check)< 1){
            PerformanceFactor::where('id', $id)->delete(); 
            return redirect()->intended('system-management/factor');   
        }else{
            return redirect()->intended('system-management/factor')->withErrors(array("error"=>'Factor assigned to employee!'));
        }
    }

    /**
     * Search team from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [
            'name' => $request['name']
            ];

       $factors = $this->doSearchingQuery($constraints);
       return view('system-mgmt/factor/index', ['factors' => $factors, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
            $query = DB::table('performance_factor')
        ->Join('department', 'performance_factor.department_id', '=', 'department.id')
        ->select('performance_factor.*', 'department.name as department_name');

        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where( 'performance_factor.name', 'like', '%'.$constraint.'%');
            }

            $index++;
        }
        return $query->paginate(20);
    }

    
    private function validateInput($request) {
        $this->validate($request, [
        'name' => 'required|max:60'
        //'name' => 'required|max:60|unique:performance_factor'

    ]);
    }
}
