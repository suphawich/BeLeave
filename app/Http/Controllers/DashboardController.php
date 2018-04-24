<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Gbrock\Table\Facades\Table;
use App\User;
use App\User_setting;
use App\Department;
use App\Leave;
use Auth;

class DashboardController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index(Request $request) {
        return view('dashboard.index');
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
            $supervisor_id = Auth::user()->id;
            // $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('Users', 'departments.subordinate_id', '=', 'Users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('Users.*', 'tasks.task')->paginate(15);
            // return view('dashboard.users', ['subordinates' => $subordinates]);

            $data = array();
            $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->get()->toArray();
            // foreach ($subordinates as $subordinate) {
            //     $subordinate['supervisor_name'] = $request->session()->get('full_name');
            // }
            while (count($subordinates) > 0) {
                $subordinate = array_shift($subordinates);
                if (!array_key_exists('supervisor_name', $subordinate)) {
                    $subordinate['supervisor_name'] = Auth::user()->full_name;
                }
                $data[] = (object) $subordinate;
                $childs = Department::where('supervisor_id', $subordinate['id'], 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->get()->toArray();
                foreach ($childs as $child) {
                    $child['supervisor_name'] = $subordinate['full_name'];
                    $subordinates[] = $child;
                }
            }

            // Get current page form url e.x. &page=1
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            // Create a new Laravel collection from the array data
            $itemCollection = collect($data);
            // Define how many items we want to be visible in each page
            $perPage = 15;
            // Slice the collection to get the items to display in current page
            $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
            // Create our paginator and pass it to the view
            $data= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            // set url path for generted links
            $data->setPath($request->url());

            // return $data;
            return view('dashboard.users', ['subordinates' => $data]);
        } else {
            return redirect('login');
        }
    }

    public function getSetting(Request $request) {
        $user_id = Auth::user()->id;
        $setting = User_setting::where('user_id', $user_id)->first();
        return view('dashboard.setting', ['setting' => $setting]);
    }

    public function getRequest(Request $request) {
        $supervisor_id = $request->session()->get('id');
        $settings = Department::where('supervisor_id', $supervisor_id, 'desc')->join('user_settings', 'departments.subordinate_id', '=', 'user_settings.user_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*','user_settings.*')->where('is_r2sup', '1')->paginate(15);
        // $table = Table::create($settings, ['full_name']);
        return view('dashboard.request', ['settings' => $settings]);
    }

    public function getLeave(Request $request) {
        $leaves = Leave::where('subordinate_id', $request->session()->get('id'))->paginate(10);
        if (Leave::where('subordinate_id', $request->session()->get('id'))->where('is_enabled', '1')->count() == 1) {
            return view('dashboard.leave', ['leaves' => $leaves, 'isPending' => 1]);
        }
        return view('dashboard.leave', ['leaves' => $leaves]);
    }

    public function getRequestLeave(Request $request) {
        $supervisor_id = $request->session()->get('id');
        // $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*')->join('leaves', 'users.id', '=', 'leaves.subordinate_id')->select('leaves.*')->paginate(15);
        $requests = Department::where('supervisor_id', $supervisor_id, 'desc')->join('leaves', 'departments.subordinate_id', '=', 'leaves.subordinate_id')->join('users', 'departments.subordinate_id', '=', 'users.id')->select('leaves.*', 'users.full_name')->paginate(15);
        // $table = Table::create($settings, ['full_name']);
        return view('dashboard.manageLeave', ['requests' => $requests]);
    }

    private function hasLogedin($request) {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }
}
