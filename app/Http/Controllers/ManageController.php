<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Account_setting;

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

    public function takeLeave(Request $request) {
        return "Hello";
    }
}
