<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Leave;
use App\User;

class LeavesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::where('subordinate_id', Auth::user()->id)->paginate(10);
        if (Leave::where('subordinate_id', Auth::user()->id)->where('is_enabled', '1')->count() == 1) {
            return view('leaves.index', ['leaves' => $leaves, 'isPending' => 1]);
        }
        return view('leaves.index', ['leaves' => $leaves]);
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

        $leave = new Leave;
        $leave->subordinate_id = Auth::user()->id;
        if ($request->input('token') != '') {
            $leave->substitute_id = User::where('token', $request->input('substitute_token'))->first()->id;
        }
        $leave->description = $request->input('description');
        $leave->leave_type = $request->input('leave_type');
        $leave->depart_at = $request->input('depart_at');
        $leave->arrive_at = $request->input('arrive_at');
        $leave->save();
        $request->session()->flash('leave_status', 'Request leave to your supervisor successful.');
        return redirect()->back();
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
