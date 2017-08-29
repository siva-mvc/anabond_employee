<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PerformanceFactor;
use App\Department;

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
        $factors = PerformanceFactor::paginate(5);

        return view('system-mgmt/factor/index', ['factors' => $factors]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $departments = Department::all();
        return view('system-mgmt/factor/create', ['departments' => $departments]);
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
         PerformanceFactor::create([
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'description' => $request['description']
        ]);

        return redirect()->intended('system-management/factor');
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
        $departments = Department::all();
        $factor = PerformanceFactor::find($id);
        // Redirect to factor list if updating factor wasn't existed
        if ($factor == null || count($factor) == 0) {
            return redirect()->intended('/system-management/factor');
        }

        return view('system-mgmt/factor/edit', ['factor' => $factor, 'departments' =>$departments]);
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
        $this->validateInput($request);
        $input = [
            'name' => $request['name'],
            'department_id' => $request['department_id'],
            'description' => $request['description']
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
        PerformanceFactor::where('id', $id)->delete();
         return redirect()->intended('system-management/factor');
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
        $query = PerformanceFactor::query();
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
        'name' => 'required|max:60|unique:performance_factor'
    ]);
    }
}
