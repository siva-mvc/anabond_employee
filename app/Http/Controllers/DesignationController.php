<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Designation;
use App\Team;

class DesignationController extends Controller
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
        $designations = DB::table('designation')
        ->select('designation.id', 'designation.name')
        ->paginate(5);

        return view('system-mgmt/designation/index', ['designations' => $designations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams = Team::all();
        return view('system-mgmt/designation/create', ['teams' => $teams]);
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
         Designation::create([
            'name' => $request['name'],
            'team_id' => 0
        ]);

        return redirect()->intended('system-management/designation');
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
        $designation = Designation::find($id);
        // Redirect to designation list if updating designation wasn't existed
        if ($designation == null || count($designation) == 0) {
            return redirect()->intended('/system-management/designation');
        }
        $teams = Team::all();

        return view('system-mgmt/designation/edit', ['designation' => $designation, "teams" =>$teams]);
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
        $designation = Designation::findOrFail($id);
        if ($designation->name != $request['name']) {
            $this->validateInput($request);  
        }
        
        $input = [
            'name' => $request['name'],
            'team_id' => 0
        ];
        Designation::where('id', $id)
            ->update($input);
        
        return redirect()->intended('system-management/designation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Designation::where('id', $id)->delete();
         return redirect()->intended('system-management/designation');
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

       $designation = $this->doSearchingQuery($constraints);
       return view('system-mgmt/designation/index', ['designations' => $designation, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = designation::query();
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
        'name' => 'required|max:60|unique:designation'
    ]);
    }

}
