<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class NotificationsController extends Controller
{
    public function markAsRead_manageRequestLeave(Request $request) {
        Auth::user()->unreadnotifications->markAsRead();
        return redirect('/manage/request/leave');
    }
}
