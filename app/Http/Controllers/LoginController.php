<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function check(Request $request) {
        if ($request->session()->has('id')) { return redirect('dashboard');}
        $data = array(
            'isWrong' => 'true'
        );
        if ($request->has(['email', 'password'])) {
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
        } else {
            return view('login.index');
        }
    }

    public function getLogout(Request $request) {
        $request->session()->flush();
        return redirect('login');
    }
}
