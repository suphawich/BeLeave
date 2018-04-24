<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\User_setting;
use App\Department;
use App\Task;

class AccountController extends Controller
{
    private function defaultAvatarPath() {
        return 'C:\xampp\htdocs\BeLeave\public\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
    }
}
