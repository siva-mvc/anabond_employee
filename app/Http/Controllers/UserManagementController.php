<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;
use App\User;
use App\Permission;
use App\Roles;

class UserManagementController extends Controller
{
       /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user-management';

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
        $users = User::paginate(20);

        $users = DB::table('users')
        ->leftJoin('perminssion', 'users.id', '=', 'perminssion.user_id')
        ->select('users.*', 'perminssion.perminssion_level as perminssion_level')
        ->paginate(20);
        return view('users-mgmt/index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users-mgmt/create');
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

        $path = $request->file('picture')->store('avatars');
         User::create([
           
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'picture' => $path
        ]);

        return redirect()->intended('/user-management');
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
        $user = User::find($id);
        $role = Roles::orderBy('Role', 'asc')->get();
        // Redirect to user list if updating user wasn't existed
        if ($user == null || count($user) == 0) {
            return redirect()->intended('/user-management');
        }

        return view('users-mgmt/edit', ['user' => $user, 'roleslist' => $role]);
    }


    public function grandPerminsssion($user_id)
    {
        $perm = array('user_id' => $user_id, 'perminssion_level'=>'grand_all');
        $p = Permission::create($perm);
        return redirect()->intended('/user-management');
    }

    public function removePerminsssion($user_id)
    {
       $p = Permission::where('user_id', $user_id)->delete();
        return redirect()->intended('/user-management');
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
       
        $user = User::findOrFail($id);

        $constraints = [
            'firstname'=> 'required|max:60'
            ];
        $input = [

            'firstname' => $request['firstname'],
            'lastname' => $request['lastname'],
            'userrole' => $request['userrole']
           
        ];
        if ($request['password'] != null && strlen($request['password']) > 0) {
            $constraints['password'] = 'required|min:6|confirmed';
            $input['password'] =  bcrypt($request['password']);
        }
        if ($request->file('picture')) {
            $path = $request->file('picture')->store('avatars');
            $input['picture'] = $path;
        }

        //print_r($input);


         

        $this->validate($request, $constraints);

        User::where('id', $id)
            ->update($input);
        
        return redirect()->intended('/user-management');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id', $id)->delete();
         return redirect()->intended('/user-management');
    }

    /**
     * Search user from database base on some specific constraints
     *
     * @param  \Illuminate\Http\Request  $request
     *  @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $constraints = [

            'firstname' => $request['email'],
            'email' => $request['email'],
            'userrole' => $request['email']
            ];

       $users = $this->doSearchingQuery($constraints);
       return view('users-mgmt/index', ['users' => $users, 'searchingVals' => $constraints]);
    }

    private function doSearchingQuery($constraints) {
        $query = User::query();
        $fields = array_keys($constraints);
        $index = 0;
        foreach ($constraints as $constraint) {
            if ($constraint != null) {
                $query = $query->where('firstname', 'like', '%'.$constraint.'%')
                ->orWhere('email', 'like', '%'.$constraint.'%')
                ->orWhere('userrole', 'like', '%'.$constraint.'%')
                ->orderBy('firstname', 'ASC');
            }

            $index++;
        }
        return $query->paginate(40);
    }

    public function load($name) {
        $path = storage_path().'/app/avatars/'.$name;
        if (file_exists($path)) {
            return Response::download($path);
        }
    }
    
    private function validateInput($request) {
        $this->validate($request, [

        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|min:6|confirmed',
        'firstname' => 'required|max:60'
    ]);
    }
}
