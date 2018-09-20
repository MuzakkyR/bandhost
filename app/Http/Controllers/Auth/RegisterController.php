<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|string|unique:users|min:6',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'picture' => 'https://4pppvq-dm2305.files.1drv.com/y4mZeOHfxPGH2CVEiD26pH8_iQngF4AoS8x5Z7KfsMe1dWfluFYZqq5UTSRJHe5R6VEqppZFhBdGs2Oh5GrZCqJdochkEIaPMpzrKNhrZMp9EcE1AOqNEJ92_8qG8-mEJeCRMXfNOhgJ6lznGGFhYKAuFQAep7DdAOYAulDaooG1a9H7O4wPCZv0QADUIVByKX9eVXNT15-TYc_n_5tfTA1kw?width=300&height=300&cropmode=none',
            'role' => 'member',
        ]);
    }

}
