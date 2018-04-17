<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Department;

class UsersController extends Controller
{
    public function index() {
        $subordinates = Department::where('supervisor_id', '11')->pluck('subordinate_id');

    }

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

    public function create(Request $request) {
        $email = $request->input('email');
        // $password = str_random(20);
        $password = "mark";
        $password = password_hash($password, PASSWORD_DEFAULT);
        $fullname = $request->input('full_name');
        $avatar = $this->defaultAvatarPath();
        $access_level = "Subordinate";
        $tel = $request->input('tel');
        $companyName = $request->input('company_name');
        $is_enabled = 0;
        $token = str_random(64);

        $user = new Account;
        $user->email = $email;
        $user->password = $password;
        $user->full_name = $fullname;
        $user->avatar = $avatar;
        $user->access_level = $access_level;
        $user->tel = $tel;
        $user->company_name = $companyName;
        $user->is_enabled = $is_enabled;
        $user->token = $token;
        $user->save();

        $supervisor_id = $request->input('supervisor_id');
        $department = new Department;
        $department->supervisor_id = $supervisor_id;
        $department->subordinate_id = $user->id;
        $department->save();

        return back();
    }

    private function defaultAvatarPath() {
        return 'C:\xampp\htdocs\BeLeave\public\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
    }
}
