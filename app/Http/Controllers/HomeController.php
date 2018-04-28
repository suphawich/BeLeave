<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_setting;
use App\Leave;
use App\Department;
use App\Plan;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $plans = Plan::all();
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
      $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name','users.avatar')->paginate(10);


      return view('dashboard.index' , ['requests' => $requests, 'users' => $users , 'plans' => $plans]);


    }
}
