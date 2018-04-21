<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gbrock\Table\Facades\Table;
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
        $validatedData = $request->validate([
            'depart_at' => 'required|date|after:today',
            'arrive_at' => 'required|date|after:depart_at',
            'description' => 'required|size:500',
            'search' => 'required|exists:accounts,full_name'
        ]);

        $leave = new Leave;
        $leave->subordinate_id = $request->session()->get('id');
        $leave->description = $request->input('description');
        // $leave->substitute_id = $request->input
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        // $leave->save();
        $request->session()->flash('leave_status', 'Request leave to your supervisor successful.');
        return redirect()->back();
    }

    public function search(Request $request) {
        $accounts = Account::where('full_name', 'LIKE', $request->keyword.'%')->join('tasks', 'accounts.id', '=', 'tasks.subordinate_id')->select('accounts.full_name','accounts.token','tasks.task')->get();
        return response()->json($accounts);
    }



    public function history(){
      // $rows = Leave::get();
      $leaves = Leave::sorted()->paginate(5);
      // $table = Table::create($rows);
      // $leaves = Leave::sorted()->get();
      return view('history.index',['leaves' => $leaves]);

    }
}
