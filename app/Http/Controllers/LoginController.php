<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function check(Request $request) {
        $data = array(
            'isWrong' => 'true'
        );
        if ($request->has(['email', 'password'])) {
            $email = $request->input('email');
            $password = $request->input('password');
            $data['oldEmail'] = $email;

            $dbEmail = \App\Account::where('email', $email)->get()->toArray();
            if (count($dbEmail) > 0) {
                $dbPassword = $dbEmail[0]['password'];
                if (password_verify($password, $dbPassword)) {
                    session($dbEmail);
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
}
