<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Account;

class ProfileController extends Controller
{
    public function edit(Request $request) {
        if ($request->has(['full_name', 'company_name', 'company_email', 'address', 'tel'])) {
            $companyEmail = $request->input('company_email');
            $password = $request->session()->get('password');
            $fullname = $request->input('full_name');
            $avatar = $request->session()->get('avatar');
            $address = $request->input('address');
            $access_level = $request->input('access_level');
            $tel = $request->input('tel');
            $companyName = $request->input('company_name');
            $token = $request->session()->get('token');

            if (!$this->hasEmailNotDup($companyEmail)) {
                if ($request->hasFile('file')) {
                    $avatar = $request->file->store('/images/profiles');
                }
                $id = $request->session()->get('id');
                $data = array(
                    'email' => $companyEmail,
                    'full_name' => $fullname,
                    'avatar' => $avatar,
                    'address' => $address,
                    'tel' => $tel,
                    'company_name' => $companyName
                );
                // Storage::move(storage_path('app/'.$avatar), public_path($avatar));
                // return $avatar;
                $user = Account::where('id', $id)->update($data);
                foreach ($data as $key => $value) {
                    $request->session()->put($key, $value);
                }
                $request->session()->flash('error', 'Changed profile successfully.');
                return redirect('profile');
            }
            $request->session()->flash('error','E-mail is already used, please try again.');
            return redirect('profile');
        } else if ($request->has(['current_password', 'new_password', 'confirm_password'])) {
            $current = $request->input('current_password');
            $new = $request->input('new_password');
            $confirm = $request->input('confirm_password');
            if (password_verify($current, $request->session()->get('password'))) {
                if ($new == $confirm) {
                    $id = $request->session()->get('id');
                    $encrypt = password_hash($new, PASSWORD_DEFAULT);
                    $data = array(
                        'password' => $encrypt
                    );
                    $user = Account::where('id', $id)->update($data);
                    foreach ($data as $key => $value) {
                        $request->session()->put($key, $value);
                    }
                    $request->session()->flash('status', 'Changed Password Successful');
                    return redirect('profile');
                }
                $request->session()->flash('error','New password is not match, please try again.');
                return redirect('profile');
            } else {
                $request->session()->flash('error','Current password is wrong, please try again.');
                return redirect('profile');
            }
        } else {
            $request->session()->flash('status', 'if 1');
            return redirect('profile');
        }
    }

    private function hasEmailNotDup($email) {
        $emails = Account::where('email', $email)->get()->toArray();
        if (count($emails) > 0) {
            if (session()->get('email') == $email) {
                return false;
            }
            return true;
        }
        return false;
    }
}
