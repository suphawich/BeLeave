<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account_setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function r2sup(Request $request)
    {
        $account_id = $request->session()->get('id');
        $data = array(
            'is_r2sup' => 1
        );
        $setting = Account_setting::where('account_id', $account_id)->update($data);
        return redirect('/setting');
    }
}
