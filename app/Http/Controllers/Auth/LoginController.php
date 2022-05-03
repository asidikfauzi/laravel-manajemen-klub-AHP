<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;

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
    protected $redirectTo;

    protected function redirectTo(){

        if(Auth()->user()->role_id == "admin")
        {
            return route('admin.dashboard');
        }
        elseif(Auth()->user()->role_id == "pemain")
        {
            return route('isPemain.dashboard');
        }
        elseif(Auth()->user()->role_id == "klub")
        {
            return route('klub.dashboard');
        }
        
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');


        if(auth()->attempt(array('username'=>$username, 'password'=>$password)))
        {
            
            if(auth()->user()->role_id == "admin")
            {
                return redirect()->route('admin.dashboard');
            }
            elseif(auth()->user()->role_id == "pemain")
            {
                return redirect()->route('isPemain.dashboard');
            }
            elseif(auth()->user()->role_id == "klub")
            {
                return redirect()->route('klub.dashboard');
            }
            
        }
        else
        {
            return redirect()->route('login')->with('failed', 'Username and password are wrong');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
