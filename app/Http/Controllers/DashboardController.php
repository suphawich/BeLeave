<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Gbrock\Table\Facades\Table;
use App\User;
use App\User_setting;
use App\Department;
use App\Leave;
use App\Plan;
use Auth;

class DashboardController extends Controller
{
    public function __construct() {



        $this->middleware('auth');

    }

    public function index(Request $request) {
        $plans = Plan::paginate(4);
        $supervisor_id = Auth::user()->id;
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name');
        $users = [];
        foreach ($requests->get() as $request) {
            $u = User::where('id', $request->subordinate_id)->first();
            $obj['id'] = $u->id;
            $obj['full_name'] = $u->full_name;
            $obj['leave_count'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->count();
            $obj['leave_vacation_count'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->where('leave_type', 'Vacation')->count();
            $obj['leave_personal_errand_count'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->where('leave_type', 'Personal Errand')->count();
            $obj['leave_sick_count'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->where('leave_type', 'Sick')->count();
            $obj['leave_latest_depart'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->latest()->first()->depart_at;
            $obj['leave_latest_arrive'] = Leave::where('subordinate_id', $request->subordinate_id)->whereYear('created_at', \Carbon\Carbon::now()->year)->latest()->first()->arrive_at;
            $users[$request->subordinate_id] = (object) $obj;
        }
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('leaves.*', 'users.full_name','users.avatar','tasks.task')->paginate(5);


        return view('dashboard.index' , ['requests' => $requests, 'users' => $users , 'plans' => $plans]);
    }

    public function index_Setting(Request $request) {
        $user_id = Auth::user()->id;
        $setting = User_setting::where('user_id', $user_id)->first();
        return view('dashboard.setting', ['setting' => $setting]);
    }

    public function r2sup(Request $request)
    {
        $user_id = Auth::user()->id;
        $data = array(
            'is_r2sup' => 1
        );
        $setting = User_setting::where('user_id', $user_id)->update($data);
        return redirect('/setting');
    }
}
