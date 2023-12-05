<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table = "users";
    protected $guarded = [];

    public function getLoginUser($email)
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.role_name', 'kelompok.*', 'kelompok.id as kelompok_id')
        ->leftJoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('users.email', $email)
        ->first();
        return $data;
    }

    public function getUserByAdminKelompok($kelompok_id)
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.role_name', 'kelompok.*', 'kelompok.id as kelompok_id')
        ->leftjoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('users.kelompok_id', $kelompok_id)
        ->where(function($query) {
            $query->where('users.role_id', '!=', 1)
                ->Where('users.role_id', '!=', 7);
        })
        ->get();
        return $data;
    }

    public function getUserBySuperAdmin()
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.role_name', 'kelompok.*', 'kelompok.id as kelompok_id')
        ->leftjoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('users.role_id', '!=', 7)
        ->get();
        return $data;
    }

    public function checkEmailExists($email)
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.email')
        ->leftJoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('email', $email);
        $checkData = $data->count();
        return $checkData;
    }

    public function insertUser($data)
    {
        $users = new UsersModel;
        $save = $users->create($data);
        return $save;
    }

    public function deleteUser($id)
    {
        $users = new UsersModel;
        $users->where('id', $id)->delete();
    }

    public function getUserById($userId)
    {
        $users = new UsersModel;
        $data = $users
        ->select('users.*', 'users.id as userId', 'role.role_name', 'kelompok.*', 'kelompok.id as kelompok_id')
        ->leftjoin('role', 'role.role_id', '=', 'users.role_id')
        ->leftjoin('kelompok', 'kelompok.id', '=', 'users.kelompok_id')
        ->where('users.id', $userId)
        ->first();
        return $data;
    }
}
