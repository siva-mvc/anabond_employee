<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
//use App\Models\Social;
use App\User;
use App\Permission;
use App\Department;
//use App\Models\Role;
use Socialize;
use Session;
use Auth;

class SocialController extends Controller
{

    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);

        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');

        }
        return Socialite::driver( $provider )->with(['hd' => $providerKey['hd']])->redirect();

    }

    public function getSocialHandle( $provider )
    {

        if (Input::get('denied') != '') {

            return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');

        }

        $user = Socialite::driver( $provider )->user();
        $socialUser = null;
        Session::forget('departments');
        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {
           //$name = explode(' ', $user->name);
           $update_user = array(
                'username' => $user->name,
                'firstname' => $user->name,
                'picture' => $user->avatar);

            User::where('email', $email)->update($update_user);
            $perm = Permission::where('user_id', $userCheck['id'])->get();
            $dept = Department::where('head_of_dept', $userCheck['email'])->get();

            if(count($dept)<=0 && count($perm)<=0){
                Auth::logout();
                return response('Unauthorized.', 401);
            }elseif(count($dept)<=0 && count($perm)>0) {
                $dept = Department::All();
            }else{
                $dept = Department::where('head_of_dept', $userCheck['email'])->get();   
            }

            $dept_ids = array();
            foreach ($dept as $key => $value) {
                array_push($dept_ids, $value['id']);
            }
            Session::put("departments", $dept_ids);
            $socialUser = $userCheck;
        }else {

           $newSocialUser = new User; 
           $newSocialUser->email = $email;

           $newSocialUser->name =  $user->name;
           $newSocialUser->picture = "";
           User::create([
                'username' => $user->name,
                'firstname' =>  $user->name,
                'email' => $email,
                'picture' =>$user->avatar,
                'password' => bcrypt($email),
            ]);
           
           $dept = Department::where('head_of_dept', $email)->get(); 
           if(count($dept)>0){
                $dept_ids = array();
                foreach ($dept as $key => $value) {
                    array_push($dept_ids, $value['id']);
                }
                Session::put("departments", $dept_ids);
           }else{
            Auth::logout();
            return response('Unauthorized.', 401);
           }
        }

        if (Auth::attempt(['email' => $email, 'password' => $email])){
            return redirect()->intended('employee-management');
        }
        return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');
        
        
    }
}