<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gbrock\Table\Facades\Table;
use Validator;
use App\User;
use App\User_setting;
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
        if (Leave::where('subordinate_id', $request->session()->get('id'))->where('is_enabled', '1')->count() == 1) {
            $v = Validator::make([], []);
            // $v->errors()->add('some_field', 'some_translated_error_key');
            $v->getMessageBag()->add('interfere', 'Can\'t send more than one leave letter.');
            return redirect()->back()->withErrors($v);
        } else if ($request->input('token') == '') {
            $validatedData = $request->validate([
                'depart_at' => 'required|date|after_or_equal:today',
                'arrive_at' => 'required|date|after_or_equal:depart_at',
                'description' => 'required|max:500'
            ]);
        } else {
            $validatedData = $request->validate([
                'depart_at' => 'required|date|after_or_equal:today',
                'arrive_at' => 'required|date|after_or_equal:depart_at',
                'description' => 'required|max:500',
                'substitute_token' => 'exists:accounts,token'
            ]);
        }

        // if ($validatedData->fails()) {
        //     return redirect()->back();
        // }
        // return $validatedData;

        $leave = new Leave;
        $leave->subordinate_id = $request->session()->get('id');
        if ($request->input('token') != '') {
            $leave->substitute_id = Account::where('token', $request->input('substitute_token'))->first()->id;
        }
        $leave->description = $request->input('description');
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        $leave->save();
        $request->session()->flash('leave_status', 'Request leave to your supervisor successful.');
        return redirect('/leave');
    }

    public function search(Request $request) {
        $accounts = Account::where('full_name', 'LIKE', $request->keyword.'%')->join('tasks', 'accounts.id', '=', 'tasks.subordinate_id')->select('accounts.full_name','accounts.token','tasks.task')->where('token', '!=', $request->session()->get('token'))->get();
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
