<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Account_setting;
use App\Leave;

class ManageController extends Controller
{
    public function r2sup_accept($account_id) {
        $data = array(
            'is_r2sup' => 0,
            'r2sup' => 1
        );
        $setting = Account_setting::where('account_id', $account_id)->update($data);
        $data = array(
            'access_level' => 'Supervisor'
        );
        $account = Account::where('id', $account_id)->update($data);
        return redirect('/request');
    }

    public function r2sup_decline($account_id) {
        $data = array(
            'is_r2sup' => 0,
            'r2sup' => 0
        );
        $setting = Account_setting::where('account_id', $account_id)->update($data);
        return redirect('/request');
    }

    public function leave_accept($id) {
        $data = array(
            'is_enabled' => 0,
            'is_approved' => 1
        );
        $leave = Leave::where('id', $id)->update($data);
        return redirect('/manage/leave');
    }

    public function leave_decline($id) {
        $data = array(
            'is_enabled' => 0,
            'is_approved' => 0
        );
        $leave = Leave::where('id', $id)->update($data);
        return redirect('/manage/leave');
    }

    public function takeLeave(Request $request) {
        $leave = new Leave;
        $leave->subordinate_id = $request->session()->get('id');
        $leave->description = $request->input('description');
        // $leave->substitute_id = $request->input
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        $leave->save();
        return redirect()->back();
    }


    public function history(){
      return view('history.index');
    }
}
