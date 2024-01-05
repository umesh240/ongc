<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        /*
        $credentials = $request->only('email', 'password');
 
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }

        if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
            // The user is active, not suspended, and exists.
        }
        */
        $loginValue = $request->email;
        $password = $request->password;
        if (Auth::attempt(['email' => $loginValue, 'password' => $password, 'actv_status' => 1])
            || Auth::attempt(['cpf_no' => $loginValue, 'password' => $password, 'actv_status' => 1])) {
            $user = Auth()->user();
            $userType = $user->user_type;
            $request->session()->regenerate();
            if($userType == 0 || $userType == 1){
                return redirect()->route('dashboard');
            }elseif($userType == 2 || $userType == 2){
                return redirect()->route('my.dashboard');
            }else{
                Session::flush();
                Auth::logout();
                return redirect()->route('login');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
