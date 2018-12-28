<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Status;
use App\User;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function username()
    {
        return 'LoginName';
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->status = Status::where('Description', config('constants.status.enabled'))->first();
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }   

        $login_name = $request->get($this->username());
        $user = User::where($this->username(), $login_name)->first();

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        if($user->StatusID != $this->status->id){
            return $this->sendFailedLoginResponse($request, 'auth.failed_status');
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        // Customization: validate if client status is active (1)
        $credentials['StatusID'] = $this->status->id;
        return $credentials;
    }

    protected function sendFailedLoginResponse(Request $request, $trans = 'auth.failed')
    {
        throw ValidationException::withMessages([
            $this->username() => [trans($trans)],
        ]);
    }
}
