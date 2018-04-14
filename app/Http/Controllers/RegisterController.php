<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function save(Request $request) {
        if ($request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $fullname = $request->input('full_name');
            $companyName = $request->input('company_name');
            $companyEmail = $request->input('company_email');
            $address = $request->input('address');
            $tel = $request->input('tel');
            return view('login.index');
        } else {
            return view('register.index');
        }
    }
}
