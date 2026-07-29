<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
   // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->is_verified == 0 && $user->role_id != 1) {
            if (!$user->verification_code) {
                $user->verification_code = random_int(100000, 999999);
                $user->save();
                send_custom_email($user->email, 'Verify Your Email Address', 'emails.signup_verification', [
                    'user' => $user,
                    'code' => $user->verification_code
                ]);
            }
            Auth::logout();
            session(['verify_email' => $user->email]);
            return redirect()->route('verify.email.page')->with('warning', 'Please verify your email address to continue.');
        }

        if ($user->role_id == 1) {
            // Redirect to the admin dashboard
            return redirect()->route('admin.home');
        }
        return redirect()->intended('/');
    }


//    public function customLogin(Request $request)
//    {
//        $request->validate([
//            'email' => 'required|email',
//            'password' => 'required|min:6',
//        ]);
//        // Attempt to authenticate the user
//        $credentials = $request->only('email', 'password');
//        if (Auth::attempt($credentials)) {
//           return redirect()->intended('/')->with('success', 'Successfully Logged In');
//        }
//        return back()->with('error', 'Invalid email or password.');
//    }


    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->is_verified == 0 && $user->role_id != 1) {
                if (!$user->verification_code) {
                    $user->verification_code = random_int(100000, 999999);
                    $user->save();
                    send_custom_email($user->email, 'Verify Your Email Address', 'emails.signup_verification', [
                        'user' => $user,
                        'code' => $user->verification_code
                    ]);
                }
                Auth::logout();
                session(['verify_email' => $user->email]);
                return redirect()->route('verify.email.page')->with('warning', 'Please verify your email address to continue.');
            }

            if ($user->role_id == 2) {
                return redirect()->intended('/')
                    ->with('success', 'Successfully Logged In!');
            } elseif ($user->role_id == 3) {
//                return redirect()->route('user.dashboard')
                return redirect()->intended('/')
                    ->with('success', 'Successfully Logged In!');
            }
            return redirect()->intended('/')
                ->with('success', 'Successfully Logged In');
        }

        return back()->with('error', 'Invalid email or password.');
    }
}
