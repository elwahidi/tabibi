<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return view('auth.login');
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
            'email'             => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password'          => ['required', 'string', 'min:8', 'confirmed'],
            'first_name'        => ['required', 'string', 'min:3', 'max:191'],
            'last_name'         => ['required', 'string', 'min:3', 'max:191'],
            'birth'             => ['required', 'date'],
            'address'           => ['required','string','min:10','max:191'],
            'sexe'              => ['required', 'int', 'exists:sexes,id'],
            'city'              => ['required', 'int', 'exists:cities,id'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = new User();

        return $user->onStore(
            array_merge(
                ['category' => Category::where('category','patient')->first()->id, 'face' => null],
                $data
            )
        );

    }
}
