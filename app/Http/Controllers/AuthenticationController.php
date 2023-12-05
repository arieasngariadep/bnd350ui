<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alert;
use App\Models\UsersModel;

class AuthenticationController extends Controller
{
    public function loginPage(Request $request)
    {
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        if($alertSuccess){
            $showalert = Alert::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alert::alertinfo($alertInfo);
        }else{
            $showalert = Alert::alertDanger($alert);
        }

        $passing = array(
            'alert' => $showalert,
        );
        
        return view('login', $passing);
    }

    public function loginProcess(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $today = date("Y-m-d");
        $email = $request->email;
        $password  = $request->password;
        $userLogin = UsersModel::getLoginUser($email);
        if($userLogin){ //apakah email tersebut ada atau tidak
            $pass = $userLogin->password;
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = array(
                    'userId' => $userLogin->userId,
                    'username' => $userLogin->username,
                    'email' => $userLogin->email,
                    'password' => $userLogin->password,
                    'role_id' => $userLogin->role_id,
                    'role_name' => $userLogin->role_name,
                    'kelompok_id' => $userLogin->kid,
                    'isLogin' => TRUE
                );
                $request->session()->put($ses_data);
                return redirect('dashboard');
            }else{
                return redirect()->back()->with('alert', 'Wrong Password');
            }
        }else{
            return redirect('/login')->with('alert', 'Email or Password Unmatched');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/login');
    }
}
