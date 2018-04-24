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
        $user_id = Auth::user()->id;
        $data = array(
            'is_r2sup' => 1
        );
        $setting = User_setting::where('user_id', $user_id)->update($data);
        return redirect('/setting');
    }
}
