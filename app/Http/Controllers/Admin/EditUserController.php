<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditUserController extends Controller
{
    public function index()
    {
        $Users = User::get();
        return view('admin.users.EditUsers', ['users' => $Users]);
    }

    public function EditUser($id)
    {
        $User = User::where('id', $id)->FirstOrFail();
        return view('admin.users.EditUser', ['user' => $User]);
    }

    public function EditUserRequest(int $id)
    {
        $Name = \request()->get('name');
        $Email = \request()->get('email');

        $UserModel = User::where('id', $id) -> first();
        $UserModel->name = $Name;
        $UserModel->email = $Email;
        $UserModel ->save();


        return [
            'status' => 200,
            'username' => $Name,
            'email' => $Email,
            'id' => $id
        ];
    }

    public function DeleteUser(int $id) {
        $UserModel = User::where('id', $id) -> first();
        $UserModel -> delete();

        return [
            'status' => 200,
            'username' => $UserModel -> name,
            'email' => $UserModel -> email,
            'id' => $id
        ];
    }

}
