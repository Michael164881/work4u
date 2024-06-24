<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\work_description;
use App\Models\job_request;

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

     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

   /**protected $redirectTo = '/home';

    /**
     * Override the credentials method to allow login with either IC or email.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'ic';
        return [
            $field => $login,
            'password' => $request->input('password')
        ];
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function authenticated(Request $request, $user)
    {
        // Check the role of the user and set the redirect path accordingly
        if ($user->role === 'freelancer') {
            $userLocation = $user->location;
            $workAddress = work_description::all();
            $jobRequest = job_request::all();
            return view('freelancer.pages.dashboard',compact('user', 'workAddress', 'jobRequest', 'userLocation'));
        } elseif ($user->role === 'customer') {
            $userLocation = $user->location;
            $workAddress = work_description::all();
            $jobRequest = job_request::all();
            return view('customer.pages.dashboard',compact('user', 'workAddress', 'jobRequest', 'userLocation'));
        }
    }
}
