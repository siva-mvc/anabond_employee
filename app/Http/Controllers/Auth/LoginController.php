<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Department;
use Session;
use App\Permission;
use App\PerformanceFactor;
use App\users;
use Auth;


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
        $maxLoginAttempts = 10;
        $lockoutTime = 1; // 1 minutes
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
        //Session::forget('departments');
   
        $dept = array();

        switch ($user['userrole']) {
            case 'Sysadmin':
                $dept = Department::orderBy('name', 'asc')->get();
                        if(count($dept)<1) {
                            Auth::logout();
                            return response('Please contact your IT administrator for more details.', 401);
                             }
       
                $this->sessiondept($dept);
                return redirect('employee-management');
                break;
            case 'Director':
                $dept = Department::where('director', $user['email'])->orderBy('name', 'asc')->get();
                                        if(count($dept)<=0) {
                            Auth::logout();
                            return response('Please contact your IT administrator for more details.', 401);
                             }
                $this->sessiondept($dept);
                return redirect('employee-perfromance-pdf-listnew/'.Session::get('departments')[0].'/2017');
                break;
            case 'Division head':
                $dept = Department::where('div_head', $user['email'])->orderBy('name', 'asc')->get();
                                        if(count($dept)<=0) {
                            Auth::logout();
                            return response('Please contact your IT administrator for more details.', 401);
                             }
                $this->sessiondept($dept);
                return redirect('employee-perfromance-pdf-listnew/'.Session::get('departments')[0].'/2017');
                break;
            case 'Department head':
                $dept = Department::where('head_of_dept', $user['email'])->orderBy('name', 'asc')->get();
                                        if(count($dept)<=0) {
                            Auth::logout();
                            return response('Please contact your IT administrator for more details.', 401);
                             }
                $this->sessiondept($dept);
                return redirect('employee-management');
                break;
            case 'Org Head':
                 $dept = Department::orderBy('name', 'asc')->get();
                        if(count($dept)<1) {
                            Auth::logout();
                            return response('Please contact your IT administrator for more details.', 401);
                             }
       
                $this->sessiondept($dept);
                 return redirect('employee-perfromance-pdf-listnew/'.Session::get('departments')[0].'/2017');
                break;
            case '----':
                Auth::logout();
                 return response('Please contact your IT administrator for more details.', 401);
                break;
            default:
                Auth::logout();
                 return response('Please contact your IT administrator for more details.', 401);
                break;
        }      
    }

     protected function sessiondept($dept)
    {
       $dept_ids = array();
  
       foreach ($dept as $key => $value) {
            array_push($dept_ids, $value['id']);
        }
       Session::put("departments", $dept_ids);
    }

}

