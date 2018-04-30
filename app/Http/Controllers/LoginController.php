<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User_log;

class LoginController extends Controller
{
    public function index(Request $request) {
        if ($request->session()->has('id')) { return redirect('dashboard');}
        else {return view('login.index');}
    }

    public function check(Request $request) {
        $data = array(
            'isWrong' => 'true'
        );
        // if ($request->has(['email', 'password'])) {
            $email = $request->input('email');
            $password = $request->input('password');
            $data['oldEmail'] = $email;

            $dbEmail = \App\Account::where('email', $email)->get()->toArray();
            $dbEmail = $dbEmail[0];
            if (count($dbEmail) > 0) {
                $dbPassword = $dbEmail['password'];
                if (password_verify($password, $dbPassword)) {
                    foreach ($dbEmail as $key => $value) { $request->session()->put($key, $value);}
                    $request->session()->flash('login_successful');
                    return redirect('dashboard');
                } else {
                    return view('login.index', $data);
                }
            } else {
                return view('login.index', $data);
            }
        // } else {
        //     return view('login.index');
        // }
    }

    public function logout(Request $request) {
        $user_log = new User_log;
        $user_log->user_id = Auth::user()->id;
        $user_log->action_type = "Logout";
        $user_log->save();
        Auth::logout();
        return redirect('/');
        // return "Hello";
    }
}
