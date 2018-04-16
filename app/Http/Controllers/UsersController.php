<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class UsersController extends Controller
{
    public function retoken(Request $request) {
        $new = str_random(64);
        $id = $request->session()->get('id');
        $data = array(
            'token' => $new
        );
        Account::where('id', $id)->update($data);
        $request->session()->put('token', $new);
        return redirect()->back();
    }
}
