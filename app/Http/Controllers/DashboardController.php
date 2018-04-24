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

    public function getSetting(Request $request) {
        $user_id = Auth::user()->id;
        $setting = User_setting::where('user_id', $user_id)->first();
        return view('dashboard.setting', ['setting' => $setting]);
    }

    private function hasLogedin($request) {
        if (Auth::check()) {
            return true;
        } else {
            return false;
        }
    }
}
