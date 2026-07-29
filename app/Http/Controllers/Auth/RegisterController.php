<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role_id'    => 3,
            'password' => Hash::make($data['password']),
        ]);
    }


    public function userRegister(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
            'role_id' => 'required',
        ]);

        if(User::where('email', $request->email)->first() != null){
            return redirect()->back()->with('warning', 'Registration failed. Email already Exists !');
        }
        if ($request->terms_conditiond) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            $data['verification_code'] = random_int(100000, 999999);
            $data['is_verified'] = 0;
            $user = User::create($data);

            // Send Verification Code Email
            send_custom_email($user->email, 'Verify Your Email Address', 'emails.signup_verification', [
                'user' => $user,
                'code' => $user->verification_code
            ]);

            session(['verify_email' => $user->email]);

            return redirect()->route('verify.email.page')->with('success', 'Successfully registered! Please enter the 6-digit verification code sent to your email.');
        }else{
            return redirect()->back()->with('error', 'Registration failed.Please try again later!');
        }
    }


    public function sellerRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|numeric',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

        if(User::where('email', $request->email)->first() != null){
            return redirect()->back()->with('warning', 'Registration failed. Email already Exists !');
        }

        if ($request->terms_conditiond) {
            $data = $request->all();
            $data['role_id'] = 2;
            $data['password'] = Hash::make($request->password);
            $data['verification_code'] = random_int(100000, 999999);
            $data['is_verified'] = 0;
            // Create new user
            $user = User::create($data);

            // Send Verification Code Email
            send_custom_email($user->email, 'Verify Your Email Address', 'emails.signup_verification', [
                'user' => $user,
                'code' => $user->verification_code
            ]);

            session(['verify_email' => $user->email]);

            return redirect()->route('verify.email.page')->with('success', 'Successfully registered as designer! Please enter the 6-digit verification code sent to your email.');
        }else{
            return redirect()->back()->with('error', 'Registration failed.Please try again later!');
        }
    }

    public function verifyEmailPage()
    {
        $email = session('verify_email');
        if (!$email) {
            return redirect()->route('signin')->with('error', 'Please register or sign in first.');
        }
        return view('auth.verify-email', compact('email'));
    }

    public function verifyEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|string|max:6',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        if ($user->verification_code == $request->code) {
            $user->is_verified = 1;
            $user->email_verified_at = now();
            $user->verification_code = null;
            $user->save();

            Auth::login($user);
            session()->forget('verify_email');

            return redirect()->intended('/')->with('success', 'Email verified successfully! Welcome to Chobi Dokan.');
        }

        return redirect()->back()->with('error', 'Invalid verification code. Please try again.');
    }

    public function resendVerificationCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $user->verification_code = random_int(100000, 999999);
        $user->save();

        send_custom_email($user->email, 'Verify Your Email Address', 'emails.signup_verification', [
            'user' => $user,
            'code' => $user->verification_code
        ]);

        return redirect()->back()->with('success', 'Verification code resent successfully.');
    }


}
