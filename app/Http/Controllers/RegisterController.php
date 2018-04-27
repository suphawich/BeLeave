<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;
use App\Plan;
use Auth;
use App\User;
use App\Supervisor_detail;
use App\Supervisor_plan;
use App\Transaction;

class RegisterController extends Controller
{
    public function save(Request $request) {
        if ($request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $companyEmail = $request->input('company_email');
            $password = $this->genePassword();
            $password = password_hash($password, PASSWORD_DEFAULT);
            $fullname = $request->input('full_name');
            $avatar = $this->defaultAvatarPath();
            $address = $request->input('address');
            $access_level = "Guest";
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');
            $is_enabled = 0;
            $token = $this->geneToken();

            $user = new Account;
            $user->email = $companyEmail;
            $user->password = $password;
            $user->full_name = $fullname;
            $user->avatar = $avatar;
            $user->address = $address;
            $user->access_level = $access_level;
            $user->tel = $tel;
            $user->company_name = $companyName;
            $user->is_enabled = $is_enabled;
            $user->token = $token;
            $user->save();



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

    private function defaultAvatarPath() {
        return 'C:\xampp\htdocs\BeLeave\public\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
    }

    public function payment(User $user ,Plan $plan){
      $plans = Plan::all();
      $users= Auth::user()->id;
      return view('register.payment',['user'=>$user,'plan'=>$plan]);
    }
    public function updatepayment(Request $request, $user,$plan)
    {
        $user = User::findOrFail($user);
        $plan = Plan::findOrFail($plan);
        $user->access_level='Manager';
        // dd($user,$plan);
        $user->save();
        $supervisoe_detail= new Supervisor_detail;
        $supervisoe_detail->supervisor_id=Auth::user()->id;
        $supervisoe_detail->subordinate_amount=0;
        $supervisoe_detail->is_api=true;
        $supervisoe_detail->is_line_noti=true;
        $supervisoe_detail->subordinate_capacity=$plan->capacity;
        $supervisoe_detail->link_create_subordinate="blaaa";
        $supervisoe_detail->save();
        $supervisor_plans= new Supervisor_plan;
        $supervisor_plans->supervisor_id=Auth::user()->id;
        $supervisor_plans->plan=$plan->name;
        $supervisor_plans->save();
        $transaction= new Transaction;
        $transaction->supervisor_id=Auth::user()->id;
        $transaction->plan_id=$plan->id;
        $transaction->payment_type= $request->payment_type;
        $transaction->save();
        return view('register.complete',['plan'=>$plan]);
    }
}
