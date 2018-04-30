<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Table;
use Mail;
use Auth;
use App\User;
use App\User_setting;
use App\Task;
use App\Department;
use PDF;

use App\System_log;

class UsersController extends Controller
{
    protected $user;

    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $supervisor_id = Auth::user()->id;

        $data = array();
        $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')
                    ->join('users', 'departments.subordinate_id', '=', 'users.id')
                    ->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')
                    ->select('users.*', 'tasks.task')
                    ->get()
                    ->toArray();
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

        $isFull = 0;
        if (Auth::user()->access_level == 'Guest' and count($data) >= 3) {
            $isFull = 1;
        }

        // return $news;
        return view('users.index', [
            'subordinates' => $data,
            'isFull' => $isFull
        ]);
    }

    public function index_account() {
        $type = [
            'full_name' => 'Full Name',
            'company_name' => 'Company Name',
            'access_level' => 'Type'
        ];
        $access_level = [
            'Administrator' => 'Administrator',
            'Manager' => 'Manager',
            'Supervisor' => 'Supervisor',
            'Subordinate' => 'Subordinate',
            'Guest' => 'Guest'
        ];

        $users = User::paginate(10);
        return view('users.index_account', [
            'users' => $users,
            'access_level' => $access_level,
            'type' => $type
        ]);
    }

    public function search_account(Request $request) {
        $type = [
            'full_name' => 'Full Name',
            'company_name' => 'Company Name',
            'access_level' => 'Type'
        ];
        $access_level = [
            'Administrator' => 'Administrator',
            'Manager' => 'Manager',
            'Supervisor' => 'Supervisor',
            'Subordinate' => 'Subordinate',
            'Guest' => 'Guest'
        ];
        $request->validate([
            'search' => 'required|string|max:100|alpha',
        ]);
        $search_type = $request->input('search_type');
        $word = $request->input('search');
        $users = User::where($search_type, 'LIKE', $word.'%')->paginate(10);

        return view('users.index_account', [
            'users' => $users,
            'access_level' => $access_level,
            'type' => $type,
            'search_type' => $search_type,
            'search' => $word
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
        $email = $request->input('email');
        $pass = str_random(20);
        $password = password_hash($pass, PASSWORD_DEFAULT);
        $fullname = $request->input('full_name');
        $avatar = $this->defaultAvatarPath();
        $access_level = $request->input('access_level');
        $tel = $request->input('tel');
        $companyName = $request->input('company_name');
        $is_enabled = 0;
        $token = str_random(64);

        $user = new User;
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

        $as = new User_setting;
        $as->user_id = $user->id;
        $as->save();

        $supervisor_id = $request->input('supervisor_id');
        $department = new Department;
        $department->supervisor_id = $supervisor_id;
        $department->subordinate_id = $user->id;
        $department->save();

        $task = new Task;
        $task->subordinate_id = $user->id;
        $task->task = $request->input('task');
        $task->save();

        $this->user = $user;
          $data = array(
              'user' => $user,
              'pass' => $pass
          );

          Mail::send('email.email', $data, function ($message) {
              // $message->to('suphawich.s@ku.th', 'Suphawich')
              $message->to($this->user->email, $this->user->full_name)
                      ->subject('Regitered');
              $message->from('beleavemanagement@gmail.com', 'BeLeaveMaster');
          });

        $sysl = new System_log;
        $sysl->action_type = "Insert";
        $sysl->description = $user->id.' had insert user table';
        $sysl->save();
        $sysl = new System_log;
        $sysl->action_type = "Insert";
        $sysl->description = $user->id.' had insert department table';
        $sysl->save();
        $sysl = new System_log;
        $sysl->action_type = "Insert";
        $sysl->description = $user->id.' had insert user setting table';
        $sysl->save();
        $sysl = new System_log;
        $sysl->action_type = "Insert";
        $sysl->description = $user->id.' had insert task table';
        $sysl->save();

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $id)
    {
      return view('users.profile', ['user' => $id]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // return $user;
        if (count(Department::where('subordinate_id', $user->id)->get()) > 0) {
            $user->supervisor_name = User::where('id', Department::where('subordinate_id', $user->id)->first()->supervisor_id)
                                        ->first()->full_name;
        }
        return view('users.edit', [
            'user' => $user
        ]);
        // return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        if ($request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $validatedData = $request->validate([
                'company_name' => 'required',
                'company_email' => 'required|email',
                'full_name' => 'required|string',
                'address' => 'required|max:100',
                'tel' => 'required|numeric',
            ]);

            $companyEmail = $request->input('company_email');
            $fullname = $request->input('full_name');
            $address = $request->input('address');
            $access_level = $request->input('access_level');
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');

            if (!$this->hasEmailNotDup($companyEmail)) {
                if ($request->hasFile('file')) {
                    $avatar = $request->file->store('/images/profiles');
                    $user->avatar = '/'.$avatar;
                }
                $user->email = $companyEmail;
                $user->full_name = $fullname;
                $user->address = $address;
                $user->tel = $tel;
                $user->company_name = $companyName;
                $user->save();

                $sysl = new System_log;
                $sysl->action_type = "Alter";
                $sysl->description = $user->id.' had update information user table.';
                $sysl->save();

                $request->session()->flash('error', 'Changed profile successfully.');
                return redirect('/users/'.$user->id.'/edit');
            }
            $request->session()->flash('error','E-mail is already used, please try again.');
            return redirect('/profile');
        } else if ($request->has(['current_password', 'password', 'password_confirm'])) {
            $validatedData = $request->validate([
                'current_password' => 'required',
                'password' => 'required',
                'password_confirm' => 'required|same:password',
            ]);
            $current = $request->input('current_password');
            $new = $request->input('password');
            $confirm = $request->input('password_confirm');
            if (password_verify($current, Auth::user()->password)) {
                $user->password = password_hash($new, PASSWORD_DEFAULT);
                $user->save();
                $request->session()->flash('error', 'Changed Password Successful');
                return redirect('/users/'.$user->id.'/edit');
            } else {
                $request->session()->flash('error','Current password is wrong, please try again.');
                return redirect('/users/'.$user->id.'/edit');
            }
        } else {
            $request->session()->flash('error', 'Error action type.');
            return redirect('/users/'.$user->id.'/edit');
        }
    }

    public function update_account(Request $request, User $user)
    {
        if ($user->email === $request->input('company_email')) {
            $request->validate([
                'full_name' => 'required|string|max:50',
                'address' => 'required|string|max:100',
                'tel' => 'required|numeric',
                'company_name' => 'required|string|max:50',
            ]);
        } else {
            $request->validate([
                'company_email' => 'required|email|unique:users,email',
                'full_name' => 'required|string|max:50|alpha',
                'address' => 'required|string|max:100',
                'tel' => 'required|numeric',
                'company_name' => 'required|string|max:50',
            ]);
        }

        $user->email = $request->input('company_email');
        $user->full_name = $request->input('full_name');
        if ($request->hasFile('file')) {
            $user->avatar = $request->file->store('/images/profiles');
        }
        $user->address = $request->input('address');
        if ($request->has('access_level')) {
            $user->access_level = $request->input('access_level');
        }
        $user->tel = $request->input('tel');
        $user->company_name = $request->input('company_name');
        $user->save();

        $sysl = new System_log;
        $sysl->action_type = "Alter";
        $sysl->description = Auth::user()->id.' had update '.$user->id.'information.';
        $sysl->save();

        $request->session()->flash('error', 'Changed '.$user->full_name.' information successful.');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        $sysl = new System_log;
        $sysl->action_type = "Delete";
        $sysl->description = $user->id.' had delete from user table';
        $sysl->save();

        // $user->is_enabled = 0;
        // $user->save();
        return back();
    }

    public function search(Request $request) {
        $supervisor_id = Auth::user()->id;
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
        return view('users.index', ['subordinates' => $data]);
    }

    public function retoken(User $user) {
        $new = str_random(64);
        $user->token = $new;
        $user->save();
        return redirect()->back();
    }

    private function defaultAvatarPath() {
        return 'C:\xampp\htdocs\BeLeave\public\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
    }

    private function hasEmailNotDup($email) {
        $emails = User::where('email', $email)->get()->toArray();
        if (count($emails) > 0) {
            if (Auth::user()->email == $email) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function getPDFUser(Request $request){
        $supervisor_id = Auth::user()->id;

        $data = array();
        $subordinates = Department::where('supervisor_id', $supervisor_id, 'desc')->join('users', 'departments.subordinate_id', '=', 'users.id')->join('tasks', 'departments.subordinate_id', '=', 'tasks.subordinate_id')->select('users.*', 'tasks.task')->get()->toArray();
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

        $pdf=PDF::loadView('users.pdf',['subordinates' => $data]);

        return $pdf->stream('pdf.pdf');
    }
}
