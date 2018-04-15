<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function check(Request $request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            $access_level = $request->session()->get('access_level');
            if ($access_level == "Administrator") {
                return view('dashboard.administrator');
            } else if ($access_level == "Supervisor") {
                return view('dashboard.supervisor');
            } else if ($access_level == "Subordinate") {
                return view('dashboard.subordinate');
            } else {
                return view('dashboard.guest');
            }
        } else {
            return redirect('login');
        }
    }
}
