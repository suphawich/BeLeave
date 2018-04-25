<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Lava;
use App\Leave;
use App\User;
use App\Department;

class AnalyticController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $supervisor_id = Auth::user()->id;
        $data = array();
        $subordinates = Department::where('supervisor_id', $supervisor_id)->leftjoin('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*')->get()->toArray();
        while (count($subordinates) > 0) {
            $subordinate = array_shift($subordinates);
            if (!array_key_exists('supervisor_name', $subordinate)) {
                $subordinate['supervisor_name'] = Auth::user()->full_name;
            }
            if (!array_key_exists('leave_count', $subordinate)) {
                $subordinate['leave_count'] = Leave::where('subordinate_id', $subordinate['id'])->whereYear('created_at', \Carbon\Carbon::now()->year)->count();
            }
            $data[] = (object) $subordinate;
            $childs = Department::where('supervisor_id', $subordinate['id'])->leftjoin('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*')->get()->toArray();
            foreach ($childs as $child) {
                $child['supervisor_name'] = $subordinate['full_name'];
                $subordinates[] = $child;
            }
        }

        usort($data, function ($a, $b) {
            if($a->leave_count == $b->leave_count){ return 0 ; }
            return ($a->leave_count > $b->leave_count) ? -1 : 1;
        });

        $counts = Lava::DataTable();
        $counts->addStringColumn('Leave Popular Poll')
              ->addNumberColumn('Leave Count');
        $c = 0;
        foreach ($data as $value) {
            if ($c == 5) { break;}
            $counts->addRow([$value->full_name, $value->leave_count]);
            $c++;
        }

        Lava::BarChart('LeavePopular', $counts, [
            'title' => 'Most 5 popular take a leave',
            // 'backgroundColor'   => ['green'],
            'colors'   => ['#96AFBD'],
            'max' => 10,
            'barGroupWidth' => '10%'
        ]);
        return view('analytic.graph');
    }

}
