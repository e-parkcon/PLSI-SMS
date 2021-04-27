<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    // protected $redirectTo = '/home';
    protected $redirectTo = '/sms/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $identity  = request()->get('empno');
        $password  = request()->get('password');
        $fieldName = filter_var($identity, FILTER_VALIDATE_EMAIL) ? 'empno' : 'empno';
        
        if (Auth::attempt(['empno' => $identity, 'password' => $password, 'active' => "Y"])) {
            // The user is active, not suspended, and exists.
            request()->merge([$fieldName => $identity]);
            return $fieldName;
        }

        // if (Auth::loginUsingId($empno)) {
        //     return redirect()->intended('/home');
        // }
        
    }
}
