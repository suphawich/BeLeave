<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\User_setting;
use App\Task;
use App\Department;
// use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Curl;

class UsersController extends Controller
{
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

        // return $news;
        return view('users.index', ['subordinates' => $data]);
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
        // $password = str_random(20);
        $password = "mark";
        $password = password_hash($password, PASSWORD_DEFAULT);
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

      // $user = User::where('id','=','$id');
      // dd( $user->id );
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
        return view('users.edit', [
            'user' => $user
        ]);
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
            $companyEmail = $request->input('company_email');
            $password = $request->session()->get('password');
            $fullname = $request->input('full_name');
            $avatar = $request->session()->get('avatar');
            $address = $request->input('address');
            $access_level = $request->input('access_level');
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');

            if (!$this->hasEmailNotDup($companyEmail)) {
                if ($request->hasFile('file')) {
                    $avatar = $request->file->store('/images/profiles');
                }
                $user->email = $companyEmail;
                $user->full_name = $fullname;
                $user->avatar = $avatar;
                $user->address = $address;
                $user->tel = $tel;
                $user->company_name = $companyName;
                $user->save();
                // $user = User::where('id', $id)->update($data);
                // foreach ($data as $key => $value) {
                //     $request->session()->put($key, $value);
                // }
                $request->session()->flash('error', 'Changed profile successfully.');
                return redirect('/users/'.$user->id.'/edit');
            }
            $request->session()->flash('error','E-mail is already used, please try again.');
            return redirect('profile');
        } else if ($request->has(['current_password', 'new_password', 'confirm_password'])) {
            $current = $request->input('current_password');
            $new = $request->input('new_password');
            $confirm = $request->input('confirm_password');
            if (password_verify($current, Auth::user()->password)) {
                if ($new == $confirm) {
                    $user->password = password_hash($new, PASSWORD_DEFAULT);
                    $user->save();
                    $request->session()->flash('error', 'Changed Password Successful');
                    return redirect('/users/'.$user->id.'/edit');
                }
                $request->session()->flash('status','New password is not match, please try again.');
                return redirect('/users/'.$user->id.'/edit');
            } else {
                $request->session()->flash('error','Current password is wrong, please try again.');
                return redirect('/users/'.$user->id.'/edit');
            }
        } else {
            $request->session()->flash('error', 'if 1');
            return redirect('/users/'.$user->id.'/edit');
        }
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
        return redirect('/users');
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


    public function hello(Request $request) {
        $data = [
            'grant_type' => 'authorization_code',
            'code' => $request->input('code'),
            'redirect_uri' => 'http://localhost:7000/line2',
            'client_id' => '1577161245',
            'client_secret' => '2cd5df01ba44cfcf3e0e3b0ada97aa4e'
        ];
        $client = new Client();
        // $client = new Client(['base_uri' => 'https://api.line.me/v2/oauth/accessToken']);
        // $response = $client->request('POST', 'https://api.line.me/oauth2/v2.1/token', [
        //     'form_params' => [
        //         'grant_type' => 'authorization_code',
        //         'code' => $request->input('code'),
        //         'client_id' => '1577161245',
        //         'client_secret' => '2cd5df01ba44cfcf3e0e3b0ada97aa4e',
        //         'redirect_uri' => 'http://localhost:7000/line'
        //     ]
        // ]);
        // $response = Curl::to('https://api.line.me/v2/oauth/accessToken')
        $response = Curl::to('https://api.line.me/oauth2/v2.1/token')
            ->withContentType('application/x-www-form-urlencoded')
            ->withData( $data )
            ->post();
        return $response;
    }

    public function hello2(Request $request) {
        return $request;
    }


}
