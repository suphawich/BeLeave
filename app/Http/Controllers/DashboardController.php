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
