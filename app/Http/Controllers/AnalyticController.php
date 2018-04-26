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

    public function index(Request $request) {
        $years = array();
        foreach (Leave::get() as $leave) {
            $year = $leave->created_at->year;
            $years[$year] = $year;
        }

        if ($request->has('year')) {
            $year = $request->input('year');
        } else {
            $year = \Carbon\Carbon::now()->year;
        }
        $this->makeCharts($year);

        return view('analytic.graph', [
            'years' => $years,
            'year' => $year
        ]);
    }

    private function makeCharts($year) {
        $data = array();
        $subordinates = Department::where('supervisor_id', Auth::user()->id)->leftjoin('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*')->get()->toArray();
        while (count($subordinates) > 0) {
            $subordinate = array_shift($subordinates);
            if (!array_key_exists('supervisor_name', $subordinate)) {
                $subordinate['supervisor_name'] = Auth::user()->full_name;
            }
            if (!array_key_exists('leave_count', $subordinate)) {
                $subordinate['leave_count'] = Leave::where('subordinate_id', $subordinate['id'])->whereYear('created_at', $year)->count();
            }
            $data[] = (object) $subordinate;
            $childs = Department::where('supervisor_id', $subordinate['id'])->leftjoin('users', 'departments.subordinate_id', '=', 'users.id')->select('users.*')->get()->toArray();
            foreach ($childs as $child) {
                $child['supervisor_name'] = $subordinate['full_name'];
                $subordinates[] = $child;
            }
        }

        // Sort Object DESC
        usort($data, function ($a, $b) {
            if($a->leave_count == $b->leave_count){ return 0 ; }
            return ($a->leave_count > $b->leave_count) ? -1 : 1;
        });

        $counts = Lava::DataTable();
        $counts->addStringColumn('Leave Popular '.$year.' Poll')
              ->addNumberColumn('Leave Count');
        $c = 0;
        foreach ($data as $value) {
            if ($c == 5) { break;}
            $counts->addRow([$value->full_name, $value->leave_count]);
            $c++;
        }

        Lava::BarChart('LeavePopular-'.$year, $counts, [
            'title' => 'Most 5 popular take a leave ('.$year.')',
            'colors'   => ['#96AFBD'],
            'max' => 10,
        ]);

        // Sort Object ASC
        usort($data, function ($a, $b) {
            if($a->leave_count == $b->leave_count){ return 0 ; }
            return ($a->leave_count < $b->leave_count) ? -1 : 1;
        });

        $mincounts = Lava::DataTable();
        $mincounts->addStringColumn('Leave Least '.$year.' Poll')
              ->addNumberColumn('Leave Count');
        $c = 0;
        foreach ($data as $value) {
            if ($c == 5) { break;}
            $mincounts->addRow([$value->full_name, $value->leave_count]);
            $c++;
        }

        Lava::BarChart('LeaveLeast-'.$year, $mincounts, [
            'title' => 'Top 5 least leave ('.$year.')',
            'colors'   => ['#96AFBD'],
            'max' => 10,
        ]);

        $leave_vacation_count = Leave::where('leave_type', 'Vacation')->whereYear('created_at', $year)->count();
        $leave_personal_errand_count = Leave::where('leave_type', 'Personal Errand')->whereYear('created_at', $year)->count();
        $leave_sick_count = Leave::where('leave_type', 'Sick')->whereYear('created_at', $year)->count();
        $leave_total_count = $leave_vacation_count + $leave_personal_errand_count + $leave_sick_count;
        $leave_count = Lava::DataTable();
        $leave_count->addStringColumn('LeaveCount')
                  ->addNumberColumn('Percent')
                  ->addRow(['Vacation', $leave_vacation_count]) //($leave_vacation_count*100)/$leave_total_count
                  ->addRow(['Personal Errand', $leave_personal_errand_count])
                  ->addRow(['Sick', $leave_sick_count]);

        Lava::PieChart('LeaveCount-'.$year, $leave_count, [
            'title'  => 'Leave Count ('.$year.')',
            'is3D'   => true,
            // 'slices' => [
            //     ['offset' => 0.2],
            //     ['offset' => 0.25],
            //     ['offset' => 0.3]
            // ]
        ]);
    }
}
