<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
//use App\Models\Social;
use App\User;
//use App\Models\Role;
use Socialize;
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

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {
           $name = explode(' ', $user->name);
            
           $update_user = array(
                'username' => $name[0],
                'name' => $n$name[0]. " ".$name[1],
                'picture' => $user->avatar);

            User::where('email', $email)->update($update_user);
            $socialUser = $userCheck;

        }else {

           $newSocialUser = new User; 
           $newSocialUser->email = $email;
           $name = explode(' ', $user->name);

           $newSocialUser->name = $name[0]. " ".$name[1];
           $newSocialUser->picture = "";
           User::create([
                'name' => $name[0]. " ".$name[1],
                'email' => $email,
                'picture' =>$user->avatar,
                'password' => bcrypt($email),
            ]);
        }

        if (Auth::attempt(['email' => $email, 'password' => $email])){
            return redirect()->intended('employee-management');
        }
        return redirect()->to('/login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');
        
        
    }
}