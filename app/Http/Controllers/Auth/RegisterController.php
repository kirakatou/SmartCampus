<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\User;
use App\Member;
use App\UserActivation;
use App\Mail\RegisterMail;
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
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'nohp' => 'required|max:12',
            'email' => 'required|email|max:255|unique:members',
            'profession' => 'required|max:255',
            'password' => 'required|min:6|confirmed',
            'captcha' => 'required|captcha',
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
        $member = new Member();
        $member->name = $data['name'];
        $member->nohp = $data['nohp'];
        $member->email = $data['email'];
        $member->profession = $data['profession'];
        $member->save();
        $user = User::create([
            'username'   => $data['email'],
            'password'   => bcrypt($data['password']),
            'status'     => 'GUEST',
            'profile_id' => $member->id,
        ]);
        $activation = UserActivation::create([
            'user_id'  => $user->id,
            'token'    => str_random(20),
        ]);
        Mail::to($member->email)->send(new RegisterMail($activation->token));
        return $user;
    }
}
