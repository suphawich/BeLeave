<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Department;

class DashboardController extends Controller
{
    public function check(Request $request) {
        if ($this->hasLogedin($request)) {
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
        if ($this->hasLogedin($request)) {
            return view('dashboard.profile');
        } else {
            return redirect('login');
        }
    }

    public function getChangepwd(Request $request) {
        if ($this->hasLogedin($request)) {
            return view('dashboard.changepwd');
        } else {
            return redirect('login');
        }
    }

    public function getUsers(Request $request) {
        if ($this->hasLogedin($request)) {
            $supervisor_id = $request->session()->get('id');
            $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('accounts', 'departments.subordinate_id', '=', 'accounts.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('accounts.*', 'tasks.task')->paginate(15);
            return view('dashboard.users', ['subordinates' => $subordinates]);
        } else {
            return redirect('login');
        }
    }

    private function hasLogedin($request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            return true;
        } else {
            return false;
        }
    }
}
