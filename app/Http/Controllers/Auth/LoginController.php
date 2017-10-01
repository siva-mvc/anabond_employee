<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Department;
use Session;
use App\Permission;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

     /**
     * Determine if the user has too many failed login attempts.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function hasTooManyLoginAttempts ($request) {
        $maxLoginAttempts = 2;
        $lockoutTime = 5; // 5 minutes
        return $this->limiter()->tooManyAttempts(
            $this->throttleKey($request), $maxLoginAttempts, $lockoutTime
        );
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }
    protected function authenticated($request, $user)
    {
        Session::forget('departments');
        $dept_ids = array();

        $perm = Permission::where('user_id', $user['id'])->get();
        if(count($perm)>0){
            Session::put("is_admin", true);
            $dept = Department::All();
        }else{
            $dept = Department::where('head_of_dept', $user['email'])->get();
        }

        if(count($dept)<=0) {
            Auth::logout();
            return response('Unauthorized.', 401);
        }
       
        foreach ($dept as $key => $value) {
            array_push($dept_ids, $value['id']);
        }
        Session::put("departments", $dept_ids);
       return redirect('employee-management');
    }
}
