<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class RegisterController extends Controller
{
    public function save(Request $request) {
        if ($request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $companyEmail = $request->input('company_email');
            $password = $this->genePassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $fullname = $request->input('full_name');
            $avatar = $this->defaultAvatarPath();
            $address = $request->input('address');
            $access_level = "Guest";
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');
            $is_enabled = 0;
            $token = $this->geneToken();

            $user = new Account;
            $user->email = $companyEmail;
            $user->password = $password;
            $user->full_name = $fullname;
            $user->avatar = $avatar;
            $user->address = $address;
            $user->access_level = $access_level;
            $user->tel = $tel;
            $user->company_name = $companyName;
            $user->is_enabled = $is_enabled;
            $user->token = $token;
            $user->save();

            return redirect('/');
        } else {
            return view('register.index');
        }
    }

    private function genePassword() {
        $pwd = "";
        for ($i=0; $i < 20 ; $i++) {
            $n = rand(33, 122);
            while (($n>=37&&$n<=47)||($n>=58&&$n<=64)||($n>=91&&$n<=96)) {
                $n = rand(33, 122);
            }
            $pwd .= chr($n);
        }
        return $pwd;
    }

    private function geneToken() {
        $pwd = "";
        for ($i=0; $i < 64 ; $i++) {
            $n = rand(48, 122);
            while (($n>=58&&$n<=64)||($n>=91&&$n<=96)) {
                $n = rand(48, 122);
            }
            $pwd .= chr($n);
        }
        return $pwd;
    }

    private function defaultAvatarPath() {
        return 'C:\xampp\htdocs\BeLeave\public\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
    }
}
