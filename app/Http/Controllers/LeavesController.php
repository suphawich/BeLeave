<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Auth;
use App\Leave;
use App\User;
use App\Task;

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
        $leaves = Leave::where('subordinate_id', Auth::user()->id)->orderby('created_at', 'desc')->get();
        $substitutes = [];
        foreach ($leaves as $leave) {
            if ($leave->substitute_id === null) {
                $substitutes[$leave->substitute_id] = "-";
            } else {
                $substitutes[$leave->substitute_id] = User::where('id', $leave->substitute_id)->first()->full_name;
                // return $leave->substitute_id;
            }
        }
        $leaves = Leave::where('subordinate_id', Auth::user()->id)->orderby('created_at', 'desc')->paginate(10);

        $substitute_task = Leave::where([['substitute_id', Auth::user()->id],['is_approved', '1']])->latest()->whereDate('depart_at', '<=', \Carbon\Carbon::now())->whereDate('arrive_at', '>=', \Carbon\Carbon::now())->get();
        $subordinate = [];
        $isSubstitute = 0;
        if (count($substitute_task) == 1) {
            $substitute_task = $substitute_task->first();
            $subordinate = Task::where('subordinate_id', $substitute_task->subordinate_id)->join('users', 'users.id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->first();
            $isSubstitute = 1;
        }

        $isPending = 0;
        if (Leave::where('subordinate_id', Auth::user()->id)->where('is_enabled', '1')->count() == 1) {
            $isPending = 1;
        }
        return view('leaves.index', [
            'leaves' => $leaves,
            'substitutes_name' => $substitutes,
            'subordinate' => $subordinate,
            'substitute' => $substitute_task,
            'isSubstitute' => $isSubstitute,
            'isPending' => $isPending
        ]);
        // return $substitutes;
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
        if (Leave::where('subordinate_id', Auth::user()->id)->where('is_enabled', '1')->count() == 1) {
            $v = Validator::make([], []);
            // $v->errors()->add('some_field', 'some_translated_error_key');
            $v->getMessageBag()->add('interfere', 'Can\'t send more than one leave letter.');
            return redirect()->back()->withErrors($v);
        } else if ($request->input('token') === '') {
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
                'substitute_token' => 'exists:users,token'
            ]);
        }

        $leave = new Leave;
        $leave->subordinate_id = Auth::user()->id;
        if ($request->input('token') !== '') {
            $leave->substitute_id = User::where('token', $request->input('substitute_token'))->first()->id;
        }
        $leave->description = $request->input('description');
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        $leave->save();
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
