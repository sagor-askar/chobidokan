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
            $user = User::create($data);
           Auth::login($user);
            return redirect()->intended('/')->with('success', 'Successfully Registration completed !');
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
            //  $verificationCode = random_int(10000, 99999);
            $data = $request->all();
            // $data['verification_code'] = $verificationCode;
            $data['role_id'] = 2;
            $data['password'] = Hash::make($request->password);
            // Create new user
            $user = User::create($data);
            // Log in the new user
              Auth::login($user);
            return redirect()->intended('/')->with('success', 'Successfully Registration completed !');
        }else{
            return redirect()->back()->with('error', 'Registration failed.Please try again later!');
        }
    }


}
