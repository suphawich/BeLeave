<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User_log;
use App\System_log;
use PDF;

class LogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_userlog(Request $request)
    {
        $dates = [
            'Show All' => 'Show All'
        ];
        foreach (User_log::orderBy('created_at', 'desc')->get() as $log) {
            $date = $log->created_at;
            $date_string = date_format(date_create($date),"m/d/Y");
            $dates[$date_string] = $date_string;
        }
        if ($request->has('date')) {
            $date = $request->input('date');
            if ($request->input('date') != 'Show All') {
                $date = date_format(date_create($date),"Y-m-d");
                $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->whereDate('user_logs.created_at', $date)->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->orderBy('created_at', 'desc')->paginate(10);
            }
        } else {
            // $date = date_format(date_create(\Carbon\Carbon::now()),"Y-m-d");
            $date = 'Show All';
            $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->orderBy('created_at', 'desc')->paginate(10);
        }

        return view('logs.index_userlog', [
            'logs' => $logs,
            'dates' => $dates,
            'date' => $date
        ]);
        // return $dates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index_systemlog(Request $request)
    {
        $dates = [
            'Show All' => 'Show All'
        ];
        foreach (System_log::orderBy('created_at', 'desc')->get() as $log) {
            $date = $log->created_at;
            $date_string = date_format(date_create($date),"m/d/Y");
            $dates[$date_string] = $date_string;
        }
        if ($request->has('date')) {
            $date = $request->input('date');
            if ($request->input('date') != 'Show All') {
                $date = date_format(date_create($date),"Y-m-d");
                $logs = System_log::whereDate('created_at', $date)->orderBy('created_at', 'desc')->paginate(10);
            } else {
                $logs = System_log::orderBy('created_at', 'desc')->paginate(10);
            }
        } else {
            // $date = date_format(date_create(\Carbon\Carbon::now()),"Y-m-d");
            $date = 'Show All';
            $logs = System_log::orderBy('created_at', 'desc')->paginate(10);
        }

        return view('logs.index_userlog', [
            'logs' => $logs,
            'dates' => $dates,
            'date' => $date
        ]);
        // return $dates;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
        //
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
    public function getPDFlog(Request $request){
      $dates = [
          'Show All' => 'Show All'
      ];
      foreach (User_log::orderBy('created_at', 'desc')->get() as $log) {
          $date = $log->created_at;
          $date_string = date_format(date_create($date),"m/d/Y");
          $dates[$date_string] = $date_string;
      }
      if ($request->has('date')) {
          $date = $request->input('date');
          if ($request->input('date') != 'Show All') {
              $date = date_format(date_create($date),"Y-m-d");
              $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->whereDate('user_logs.created_at', $date)->orderBy('created_at', 'desc')->paginate(10);
          } else {
              $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->orderBy('created_at', 'desc')->paginate(10);
          }
      } else {
          // $date = date_format(date_create(\Carbon\Carbon::now()),"Y-m-d");
          $date = 'Show All';
          $logs = User_log::join('users', 'user_logs.user_id', '=', 'users.id')->select('user_logs.*', 'users.full_name')->orderBy('created_at', 'desc')->paginate(10);
      }

      $pdf=PDF::loadView('logs.index_userlog',[
          'logs' => $logs,
          'dates' => $dates,
          'date' => $date
      ]);

      return $pdf->stream('log.pdf');
    }
}
