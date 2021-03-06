<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;

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
    protected $redirectTo = '/home';
    protected $user;

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
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'tel'=>'required|max:10|unique:users',
            'company_name'=>'required|string|max:100',
            // 'access_level'=>'required|string',
            // 'is_enabled'=>'required|integer',
            // 'token'=>'required|string'


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

        $pass = str_random(20);

        $user = User::create([
            'full_name' => $data['full_name'],
            'email' => $data['email'],
            'password' => password_hash($pass, PASSWORD_DEFAULT),
            'access_level'=>'Guest',
            'tel'=>$data['tel'],
            'is_enabled'=>1,
            'company_name'=>$data['company_name'],
            'token'=>str_random(100)

        ]);
        $this->user = $user;

        $data = array(
            'user' => $user,
            'pass' => $pass
        );
        Mail::send('email.email', $data, function ($message) {
            // $message->to('suphawich.s@ku.th', 'Suphawich')
            $message->to($this->user->email, $this->user->full_name)
                    ->subject('Regitered');
            $message->from('beleavemanagement@gmail.com', 'BeLeaveMaster');
        });

        // Mail::to($user->email)->send(new DemoMail($user));

        return $user;


    }

}
