<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function check(Request $request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            $access_level = $request->session()->get('access_level');
            if ($access_level == "Administrator") {
                return view('dashboard.index');
            } else if ($access_level == "Supervisor") {
                return view('dashboard.index');
            } else if ($access_level == "Subordinate") {
                return view('dashboard.index');
            } else {
                return view('dashboard.index');
            }
        } else {
            return redirect('login');
        }
    }

    public function getProfile(Request $request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            return view('dashboard.profile');
        } else {
            return redirect('login');
        }
    }

    public function getChangepwd(Request $request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            return view('dashboard.changepwd');
        } else {
            return redirect('login');
        }
    }
}
