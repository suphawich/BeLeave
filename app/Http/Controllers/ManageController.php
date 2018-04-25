<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gbrock\Table\Facades\Table;
use Validator;
use Auth;
use App\User;
use App\User_setting;
use App\Leave;
use App\Department;

class ManageController extends Controller
{
    public function index_request() {
        $supervisor_id = Auth::user()->id;
        $settings = Department::where('supervisor_id', $supervisor_id, 'desc')->join('user_settings', 'departments.subordinate_id', '=', 'user_settings.user_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*','user_settings.*')->where('is_r2sup', '1')->paginate(15);
        return view('manage.request', ['settings' => $settings]);
    }

    public function index_request_leave() {
        $supervisor_id = Auth::user()->id;
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->paginate(15);

        return view('manage.request_leave', ['requests' => $requests]);
    }

    public function r2sup_accept($user_id) {
        $data = array(
            'is_r2sup' => 0,
            'r2sup' => 1
        );
        $setting = User_setting::where('user_id', $user_id)->update($data);
        $data = array(
            'access_level' => 'Supervisor'
        );
        $account = User::where('id', $user_id)->update($data);
        return redirect()->back();
    }

    public function r2sup_decline($user_id) {
        $data = array(
            'is_r2sup' => 0,
            'r2sup' => 0
        );
        $setting = User_setting::where('user_id', $user_id)->update($data);
        return redirect()->back();
    }

    public function leave_accept($id) {
        $data = array(
            'is_enabled' => 0,
            'is_approved' => 1
        );
        $leave = Leave::where('id', $id)->update($data);
        return redirect()->back();
    }

    public function leave_decline($id) {
        $data = array(
            'is_enabled' => 0,
            'is_approved' => 0
        );
        $leave = Leave::where('id', $id)->update($data);
        return redirect()->back();
    }

    public function search(Request $request) {
        $users = User::where('full_name', 'LIKE', $request->keyword.'%')->join('tasks', 'users.id', '=', 'tasks.subordinate_id')->select('users.full_name','users.token','tasks.task')->where('token', '!=', Auth::user()->token)->get();
        return response()->json($users);
    }

    public function history(){
      // $rows = Leave::get();

      $leaves = Leave::all();
      $supervisor_id = Auth::user()->id;
      $leaves = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->get();
      $users = User::all();
      // $d = Department::all()->pluck('subordinate_id','id');
      // $u = User::all()->pluck('full_name','id');
      // $table = Table::create($rows);
      // $leaves = Leave::sorted()->get();
      return view('history.index',['leaves' => $leaves]);
      return view('history.index',['leaves' => $leaves , 'users' => $users]);

    }
}
