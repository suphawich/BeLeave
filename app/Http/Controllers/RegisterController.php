<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Plan;
use Auth;
use App\Task;
use App\User;
use App\Supervisor_detail;
use App\Supervisor_plan;
use App\Transaction;
use App\Department;
use App\User_setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\System_log;
use Mail;

use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\LabelAlignment;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Response\QrCodeResponse;


class RegisterController extends Controller
{
    public function save(Request $request) {
        if (

          $request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $companyEmail = $request->input('company_email');
            $password = $this->genePassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $fullname = $request->input('full_name');
            $address = $request->input('address');
            $access_level = "Guest";
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');
            $is_enabled = 0;
            $token = $this->geneToken();

            $user = new User;
            $user->email = $companyEmail;
            $user->password = $password;
            $user->full_name = $fullname;
            $user->address = $address;
            $user->access_level = $access_level;
            $user->tel = $tel;
            $user->company_name = $companyName;
            $user->is_enabled = $is_enabled;
            $user->token = $token;
            $user->save();

            $sysl = new System_log;
            $sysl->action_type = "Insert";
            $sysl->description = $user->id.' had insert user table.';
            $sysl->save();

            return redirect('/');
        } else {
            return view('register.index');
        }
    }




    private function genePassword() {
        $pwd = "";
        for ($i=0; $i < 20 ; $i++) {
            $n = rand(33, 122);
            while (($n>=37&&$n<=47)||($n>=58&&$n<=64)||($n>=91&&$n<=96)) {
                $n = rand(33, 122);
            }
            $pwd .= chr($n);
        }
        return $pwd;
    }

    private function geneToken() {
        $pwd = "";
        for ($i=0; $i < 64 ; $i++) {
            $n = rand(48, 122);
            while (($n>=58&&$n<=64)||($n>=91&&$n<=96)) {
                $n = rand(48, 122);
            }
            $pwd .= chr($n);
        }
        return $pwd;
    }

    public function getQRcode(){

      $qrCode = new QrCode('localhost:8000/register/'.Auth::user()->token);
      header('Content-Type: '.$qrCode->getContentType());

      $response = new QrCodeResponse($qrCode);
      return $response;


    }

    public function payment(User $user ,Plan $plan){
      $plans = Plan::all();
      $users= Auth::user()->id;
      return view('register.payment',['user'=>$user,'plan'=>$plan]);
    }


    public function updatepayment(Request $request, $user,$plan)
    {
      $request->validate(['payment_type'=>'required']);


        $user = User::findOrFail($user);
        $plan = Plan::findOrFail($plan);
        $user->access_level='Manager';

        $user->save();
        $supervisor_detail= new Supervisor_detail;
        $supervisor_detail->supervisor_id=Auth::user()->id;
        $supervisor_detail->subordinate_amount=0;
        $supervisor_detail->is_api=true;
        $supervisor_detail->is_line_noti=true;
        $supervisor_detail->subordinate_capacity=$plan->capacity;
        $supervisor_detail->link_create_subordinate=$user->token;
        $supervisor_detail->save();

        $sysl = new System_log;
        $sysl->action_type = "Create";
        $sysl->description = $supervisor_detail->id.' had create in supervisor detail table.';
        $sysl->save();

        $supervisor_plans= new Supervisor_plan;
        $supervisor_plans->supervisor_id=Auth::user()->id;
        $supervisor_plans->plan=$plan->name;

        $supervisor_plans->exprie_plan=Carbon::now()->addDays($plan->exprie)->toDateTimeString();

        $supervisor_plans->save();

        $sysl = new System_log;
        $sysl->action_type = "Create";
        $sysl->description = $supervisor_plans->id.' had create in supervisor plan table.';
        $sysl->save();

        $transaction= new Transaction;

        $transaction->supervisor_id=Auth::user()->id;
        $transaction->plan_id=$plan->id;
        $transaction->payment_type= $request->payment_type;
        $transaction->save();

        $sysl = new System_log;
        $sysl->action_type = "Create";
        $sysl->description = $transaction->id.'had create in transaction table.';
        $sysl->save();

        return view('register.complete',['plan'=>$plan]);
    }


    public function editpro(Request $request,$user,$plan){
      $user = User::findOrFail($user);
      $plan = Plan::findOrFail($plan);
      $supervisor_plans = Supervisor_plan::all()->where('supervisor_id','LIKE',Auth::user()->id)->first();
      $supervisor_plans->plan=$plan->name;
      $supervisor_plans->save();
      $transaction= new Transaction;
      $transaction->supervisor_id=Auth::user()->id;
      $transaction->plan_id=$plan->id;
      $transaction->payment_type= $request->payment_type;
      $transaction->save();

      return view('register.complete',['plan'=>$plan]);


    }
    public function registoken(String $token,Supervisor_detail $supervisor_detail,User $user){
        $supervisor_detail=Supervisor_detail::all()->where('link_create_subordinate',"LIKE",$token)->first();
        $user=User::all()->where('token',"LIKE",$token)->first();


          return view('/register/regissubordinate',['supervisor_detail' => $supervisor_detail,'user'=>$user]);
      }

      public function regissub(Request $request){


        if ($request->validate(['full_name'=>'required|min:5|max:150',
          'email'=>'required|email|unique:users,email',
           'address',
           'tel'=>'required|min:10|max:10',
           'agree'=>'required',
           'task'=>'required'])) {

            $pass = str_random(20);

            $email = $request->input('email');
            $password = $this->genePassword();
            $password = password_hash($pass, PASSWORD_DEFAULT);
            $fullname = $request->input('full_name');
            $address = $request->input('address');
            $access_level = "Subordinate";
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');
            $is_enabled = 1;
            $token = $this->geneToken();
            $task1=$request->input('task');

            // $request->validate(['full_name'=>'required|min:5|max:150|',
            //
            //         'address'=>'required|min:10|max:150|',
            //         'email' => 'required|string|email|max:255|unique:users,email',
            //         'tel'=>'required|integer|min:9|max:10'
                  //
                  //
                  // ]);

            $user1 = new User;
            $user1->email = $email;
            $user1->password = $password;
            $user1->full_name = $fullname;
            $user1->address = $address;
            $user1->access_level = $access_level;
            $user1->tel = $tel;
            $user1->company_name = $companyName;
            $user1->is_enabled = $is_enabled;
            $user1->token = $token;
            $user1->save();

            $us = new User_setting;
            $us->user_id = $user1->id;
            $us->save();


          $task = new Task;
          $task->subordinate_id=$user1->id;
          $task->task=$task1;
          $task->save();

          $sysl = new System_log;
          $sysl->action_type = "Create";
          $sysl->description = $user1->id.' had create subordinate in user table.';
          $sysl->save();


            $department = new Department;
            $user=User::all()->where('id',"LIKE", $request->input('user'))->first();
            // dd($supervisor_detail);
            $department->supervisor_id=$user->id;
            $department->subordinate_id=$user1->id;
            $department->save();

            $sysl = new System_log;
            $sysl->action_type = "Create";
            $sysl->description = $department->id.' had create department in department table.';
            $sysl->save();

            // $supervisor_detail->subordinate_amount=$supervisor_detail->subordinate_amount+1;
            // $supervisor_detail->save();
            $this->user = $user1;
            $data = array(
                'user' => $user1,
                'pass' => $pass
            );

            Mail::send('email.email', $data, function ($message) {
                // $message->to('suphawich.s@ku.th', 'Suphawich')
                $message->to($this->user->email, $this->user->full_name)
                        ->subject('Regitered');
                $message->from('beleavemanagement@gmail.com', 'BeLeaveMaster');
            });


            return redirect('/home');
        } else {
            return view('register.index');
          }
      }





}
