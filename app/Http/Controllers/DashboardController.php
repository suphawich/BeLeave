<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Account;
use App\Account_setting;
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
            // $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('accounts', 'departments.subordinate_id', '=', 'accounts.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('accounts.*', 'tasks.task')->paginate(15);
            // return view('dashboard.users', ['subordinates' => $subordinates]);

            $data = array();
            $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('accounts', 'departments.subordinate_id', '=', 'accounts.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('accounts.*', 'tasks.task')->get()->toArray();
            // foreach ($subordinates as $subordinate) {
            //     $subordinate['supervisor_name'] = $request->session()->get('full_name');
            // }
            while (count($subordinates) > 0) {
                $subordinate = array_shift($subordinates);
                if (!array_key_exists('supervisor_name', $subordinate)) {
                    $subordinate['supervisor_name'] = $request->session()->get('full_name');
                }
                $data[] = (object) $subordinate;
                $childs = Department::where('supervisor_id', $subordinate['id'], 'desc')->join('accounts', 'departments.subordinate_id', '=', 'accounts.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('accounts.*', 'tasks.task')->get()->toArray();
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
        $account_id = $request->session()->get('id');
        $setting = Account_setting::where('account_id', $account_id)->first();
        return view('dashboard.setting', ['setting' => $setting]);
    }

    public function getRequest(Request $request) {
        $supervisor_id = $request->session()->get('id');
        $settings = Department::where('supervisor_id', $supervisor_id, 'desc')->join('account_settings', 'departments.subordinate_id', '=', 'account_settings.account_id')->join('accounts', 'departments.subordinate_id', '=', 'accounts.id')->select('accounts.*','account_settings.*')->where('is_r2sup', '1')->paginate(1);
        return view('dashboard.request', ['settings' => $settings]);
    }

    private function hasLogedin($request) {
        if ($request->session()->has('login_successful') || $request->session()->has('id')) {
            return true;
        } else {
            return false;
        }
    }
}
