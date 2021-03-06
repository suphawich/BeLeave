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
use App\Task;
use App\User_log;
use App\System_log;
use PDF;
use App\Supervisor_detail;

class ManageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index_request() {
        $supervisor_id = Auth::user()->id;
        $settings = Department::where('supervisor_id', $supervisor_id, 'desc')->join('user_settings', 'departments.subordinate_id', '=', 'user_settings.user_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*','user_settings.*')->where('is_r2sup', '1')->paginate(15);
        return view('manage.request', ['settings' => $settings]);
    }

    public function getPDFRequest(){
       $supervisor_id = Auth::user()->id;
       $settings = Department::where('supervisor_id', $supervisor_id, 'desc')->join('user_settings', 'departments.subordinate_id', '=', 'user_settings.user_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*','user_settings.*')->where('is_r2sup', '1')->paginate(15);
       $pdf=PDF::loadView('manage.pdfRequest',['settings' => $settings]);
       return $pdf->stream('pdfRequest.pdf');
    }

    public function index_request_leave() {
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
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->paginate(10);
        return view('manage.request_leave', ['requests' => $requests, 'users' => $users]);
        // return $requests;
    }

    public function getPDFRequestLeave(){
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
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->paginate(10);
        $pdf=PDF::loadView('manage.pdfRequestLeave',['requests' => $requests, 'users' => $users]);
        return $pdf->stream('pdfRequestLeave.pdf');
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
        // $supervisor_detail= new Supervisor_detail;
        // $supervisor_detail->supervisor_id = $user_id;
        // $supervisor_detail->subordinate_amount=0;
        // $supervisor_detail->is_api=true;
        // $supervisor_detail->is_line_noti=true;
        // $supervisor_detail->subordinate_capacity=$plan->capacity;
        // $supervisor_detail->link_create_subordinate=$user->token;
        // $supervisor_detail->save();
        $account = User::where('id', $user_id)->update($data);

        return redirect()->back();
    }

    public function getPDFHistory(){
        $leaves = Leave::all();
        $supervisor_id = Auth::user()->id;
        $leaves = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->get();
        $users = User::all();
        $pdf=PDF::loadView('history.pdf',['leaves' => $leaves , 'users' => $users]);
        return $pdf->stream('pdf.pdf');
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
        $leaveeave = Leave::where('id', $id)->update($data);


        return redirect()->back();
    }

    public function leave_decline($id) {
        $data = array(
            'is_enabled' => 0,
            'is_approved' => 0
        );
        $leaveeave = Leave::where('id', $id)->update($data);

        return redirect()->back();
    }

    public function search(Request $request) {
        $mytask = Task::where('subordinate_id', Auth::user()->id)->first()->task;
        $mysup = Department::where('subordinate_id', Auth::user()->id)->first();
        $users = User::where('company_name', Auth::user()->company_name)
                ->where('full_name', 'LIKE', $request->keyword.'%')
                ->join('tasks', 'users.id', '=', 'tasks.subordinate_id')
                ->join('departments', 'users.id', '=', 'departments.subordinate_id')
                ->select('users.full_name','users.token','tasks.task','departments.supervisor_id')
                ->where('tasks.task', 'LIKE', '%'.$mytask.'%')
                ->where('departments.supervisor_id', $mysup->supervisor_id)
                ->where('token', '!=', Auth::user()->token)
                ->get();
        return response()->json($users);
    }

    public function history(){

      // $rows = Leave::get();

      $leaves = Leave::all();
      $tasks = Task::all();

      $supervisor_id = Auth::user()->id;
      $leaves = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->get();
      $users = User::all();

      $leaves_self = Leave::where('subordinate_id', $supervisor_id)->join('users', 'users.id', '=' , 'leaves.subordinate_id')->select('leaves.*', 'users.full_name')->get();
      // $d = Department::all()->pluck('subordinate_id','id');
      // $u = User::all()->pluck('full_name','id');
      // $table = Table::create($rows);
      // $leaves = Leave::sorted()->get();
      return view('history.index',['leaves' => $leaves , 'users' => $users ,'tasks' => $tasks, 'leaves_self' => $leaves_self]);

    }
}
