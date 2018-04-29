<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Leave;
use App\User;
use App\Task;
use App\Department;
use \Carbon\Carbon;

class LeavesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $leaves = Leave::where('subordinate_id', Auth::user()->id)->orderby('created_at', 'desc')->get();
        $leaves = Leave::where('subordinate_id', Auth::user()->id)->orderby('created_at', 'desc')->paginate(10);

        $substitutes = Leave::where([['substitute_id', Auth::user()->id],['is_approved', '1']])
                    ->whereDate('depart_at', '>=', \Carbon\Carbon::now())
                    ->join('tasks', 'leaves.subordinate_id', '=', 'tasks.subordinate_id')
                    ->select('leaves.*', 'tasks.task')
                    ->join('users', 'users.id', '=', 'leaves.subordinate_id')
                    ->select('leaves.*', 'users.*', 'tasks.task')
                    ->paginate(10);


        $action = 0;
        if (Leave::where('subordinate_id', Auth::user()->id)->where('is_enabled', '1')->count() == 1 or
            Leave::where('subordinate_id', Auth::user()->id)->where('is_approved', '1')->whereDate('arrive_at', '>', Carbon::now())->count() == 1) {
            $action = 1;
        }
        return view('leaves.index', [
            'leaves' => $leaves,
            'substitutes' => $substitutes,
            'action' => $action
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $leave = new Leave;
        if (Leave::where('subordinate_id', Auth::user()->id)->where('is_enabled', '1')->count() == 1) {
            $v = Validator::make([], []);
            $v->getMessageBag()->add('interfere', 'Can\'t send more than one leave letter.');
            return redirect()->back()->withErrors($v);
        } else if ($request->input('substitute_token') == '') {
            $validatedData = $request->validate([
                'depart_at' => 'required|date|after_or_equal:tomorrow',
                'arrive_at' => 'required|date|after_or_equal:depart_at',
                'description' => 'required|max:100'
            ]);
        } else {
            $validatedData = $request->validate([
                'depart_at' => 'required|date|after_or_equal:tomorrow',
                'arrive_at' => 'required|date|after_or_equal:depart_at',
                'description' => 'required|max:100',
                'substitute_token' => 'exists:users,token'
            ]);
            $leave->substitute_id = User::where('token', $request->input('substitute_token'))->first()->id;
            if (Leave::where('substitute_id', $leave->substitute_id)
                    ->whereDate('depart_at', '>=', $request->input('depart_at'))
                    ->whereDate('depart_at', '<=', $request->input('arrive_at'))
                    ->count() > 0
                or Leave::where('substitute_id', $leave->substitute_id)
                    ->whereDate('arrive_at', '>=', $request->input('depart_at'))
                    ->whereDate('arrive_at', '<=', $request->input('arrive_at'))
                    ->count() > 0 )
            {
                $sl = Leave::where('substitute_id', $leave->substitute_id)->latest()->first();
                $su = User::where('id', $leave->substitute_id)->first();
                $v = Validator::make([], []);
                $v->getMessageBag()->add('interfere', 'Date was overlap with him/her leave or task.'
                                                    .'<br />'.$su->full_name.' has been substitute task since ' .date_format(date_create($sl->depart_at),"m/d/Y").' to '
                                                    .date_format(date_create($sl->arrive_at),"m/d/Y").'.');
                return redirect()->back()->withErrors($v);
            }

            if (Leave::where('subordinate_id', $leave->substitute_id)
                    ->whereDate('depart_at', '>=', $request->input('depart_at'))
                    ->whereDate('depart_at', '<=', $request->input('arrive_at'))
                    ->count() > 0
                or Leave::where('subordinate_id', $leave->substitute_id)
                    ->whereDate('arrive_at', '>=', $request->input('depart_at'))
                    ->whereDate('arrive_at', '<=', $request->input('arrive_at'))
                    ->count() > 0 )
            {
                $sl = Leave::where('subordinate_id', $leave->substitute_id)->latest()->first();
                $su = User::where('id', $leave->substitute_id)->first();
                $v = Validator::make([], []);
                $v->getMessageBag()->add('interfere', 'Date was overlap with him/her leave or task.'
                                                    .'<br />'.$su->full_name.' has been leave since ' .date_format(date_create($sl->depart_at),"m/d/Y").' to '
                                                    .date_format(date_create($sl->arrive_at),"m/d/Y").'.');
                return redirect()->back()->withErrors($v);
            }
        }

        if (Leave::where('substitute_id', Auth::user()->id)
                ->whereDate('depart_at', '>=', $request->input('depart_at'))
                ->whereDate('depart_at', '<=', $request->input('arrive_at'))
                ->count() > 0
            or Leave::where('substitute_id', Auth::user()->id)
                ->whereDate('arrive_at', '>=', $request->input('depart_at'))
                ->whereDate('arrive_at', '<=', $request->input('arrive_at'))
                ->count() > 0 )
        {
            $v = Validator::make([], []);
            $v->getMessageBag()->add('interfere', 'Date was overlap with your substitute task.');
            return redirect()->back()->withErrors($v);
        }

        $leave->subordinate_id = Auth::user()->id;
        $leave->description = $request->input('description');
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        $leave->save();

        $user = Auth::user();
        $sp_user = User::where('id', Department::where('subordinate_id', $user->id)->first()->supervisor_id)->first();
        $sp_user->notify(new \App\Notifications\RequestLeaveNotification($user, $leave));
        $request->session()->flash('leave_status', 'Request leave to your supervisor successful.');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
