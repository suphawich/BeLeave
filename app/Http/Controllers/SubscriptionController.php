<?php

namespace App\Http\Controllers;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Subscription;
use Illuminate\Http\Request;
use App\User;
use App\Department;
use Auth;
use App\Supervisor_plan;
use Carbon\Carbon;

class SubscriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {




        $supervisor_id = Auth::user()->id;

        $now = Carbon::now()->toDateTimeString();






        $plan = Supervisor_plan::where('supervisor_id', $supervisor_id, 'desc')->join('plans','plans.name', '=' , 'supervisor_plans.plan')->select('supervisor_plans.*','plans.capacity')->get();
        if(count($plan) > 0 ){
          $day_left = date_diff(date_create($now), date_create($plan[0]->exprie_plan))->format(" %a days");
        }
        else{
          $day_left = 0;
        }
        $word = $request->input('search');

        $data = array();
        $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->where('full_name', 'LIKE', $word.'%')->get()->toArray();
        while (count($subordinates) > 0) {
            $subordinate = array_shift($subordinates);
            if (!array_key_exists('supervisor_name', $subordinate)) {
                $subordinate['supervisor_name'] = Auth::user()->full_name;
            }
            $data[] = (object) $subordinate;
            $childs = Department::where('supervisor_id', $subordinate['id'], 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->get()->toArray();
            foreach ($childs as $child) {
                $child['supervisor_name'] = $subordinate['full_name'];
                $subordinates[] = $child;
            }
        }

        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($data);
        // Define how many items we want to be visible in each page
        $perPage = 15;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        // Create our paginator and pass it to the view
        $data= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        // set url path for generted links
        $data->setPath($request->url());

        // return $data;

        return view('subscription.index', ['subordinates' => $data, 'plan' => $plan,'day_left' => $day_left]);

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
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function show(Subscription $subscription)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscription $subscription)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscription  $subscription
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        //
    }
}
