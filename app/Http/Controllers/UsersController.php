<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helpers\Alert;
use App\Models\UsersModel;
use App\Models\RoleModel;
use App\Models\KelompokModel;

class UsersController extends Controller
{
    public function getListUsers(Request $request)
    {
        $role = $request->session()->get('role_id');
        $kelompok = $request->session()->get('kelompok_id');
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

        if($role == 7){
            $userList = UsersModel::getUserBySuperAdmin();
        }else{
            $userList = UsersModel::getUserByAdminKelompok($kelompok);
        }

        $passing = array(
            'role' => $role,
            'alert' => $showalert,
            'userList' => $userList,
        );

        return view('users.listUsers', $passing);
    }

    public function formAddUser(Request $request)
    {
        $role = $request->session()->get('role_id');
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

        if($role == 7){
        	$roleList = RoleModel::getAllRoleBySuperAdmin();
		}else{
        	$roleList = RoleModel::getAllRoleByAdminKelompok();
		}
        $kelompokList = KelompokModel::getAllKelompok();

        $data = array(
            'role' => $role,
            'alert' => $showalert,
            'roleList' => $roleList,
            'kelompokList' => $kelompokList
        );
        return view('users.addUser', $data);
    }

    public function prosesAddUser(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); //set you countary name from below timezone list
        $password = Hash::make($request->password);
        $checkUser = UsersModel::checkEmailExists($request->email);

        if($checkUser == 1){
            return redirect('users/formAddUser')->with('alert', 'Email Already Taken');
        }elseif($request->password != $request->confirm_password){
            return redirect('users/formAddUser')->with('alert', 'Please Enter Same Password');
        }else{
            $data = array(
                'email' => $request->email,
                'password' => $password,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'kelompok_id' => $request->kelompok_id,
                'created_at' => date("Y-m-d h:i:s"),
                'updated_at' => date("Y-m-d h:i:s"),
            );
            UsersModel::insertUser($data);

            return redirect('users')->with('alertSuccess', 'User Successfully Added');
        }
    }

    public function formUpdateUser(Request $request)
    {
        $role = $request->session()->get('role_id');
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        $uri3 = $request->segment(3);
        if($alertSuccess){
            $showalert = Alert::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alert::alertinfo($alertInfo);
        }else{
            $showalert = Alert::alertDanger($alert);
        }

        if($role == 7){
        	$roleList = RoleModel::getAllRoleBySuperAdmin();
		}else{
        	$roleList = RoleModel::getAllRoleByAdminKelompok();
		}
        $kelompokList = KelompokModel::getAllKelompok();
        $user = UsersModel::getUserById($request->id);

        $data = array(
            'role' => $role,
            'alert' => $showalert,
            'roleList' => $roleList,
            'kelompokList' => $kelompokList,
            'user' => $user,
        );
        return view('users.editUser', $data);
    }

    public function prosesUpdateUser(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok"); //set you countary name from below timezone list
        $uri3 = $request->segment(3);
        $id = $request->id;
        $oldPassword = $request->oldPassword;
        $password = Hash::make($request->password);
        $checkUser = UsersModel::checkEmailExists($request->email);
        if($checkUser > 1){
            return redirect('users/formUpdateUser/'.$id)->with('alert', 'Email Already Taken');
        }elseif($request->password != $request->confirm_password){
            return redirect('users/formUpdateUser/'.$id)->with('alert', 'Please Enter Same Password');
        }else{
            $aktifitas = "Melakukan Perubahan Data User";
            $link = base64_encode(random_bytes(32));
            $data = array(
                'email' => $request->email,
                'password' => $password,
                'username' => $request->username,
                'role_id' => $request->role_id,
                'kelompok_id' => $request->kelompok_id,
                'updated_at' => date("Y-m-d h:i:s"),
            );
            UsersModel::where('id', $id)->update($data);

            return redirect('users')->with('alertSuccess', 'User Successfully Updated');
        }
    }

    public function deleteUser(Request $request){
        $id = $request->id;
        UsersModel::deleteUser($id);
        return redirect()->back()->with('alertSuccess', 'Useer Has Been Deleted');
    }
}
