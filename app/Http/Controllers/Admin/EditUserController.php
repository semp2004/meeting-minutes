<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class EditUserController extends Controller
{
    public function index()
    {
        $Users = User::get();
        return view(view: 'admin.users.EditUsers', data: ['users' => $Users]);
    }

    public function EditUser($id)
    {
        $User = User::where('id', $id)->FirstOrFail();
        return view(view: 'admin.users.EditUser', data: ['user' => $User]);
    }

    public function EditUserRequest(int $id)
    {
        $Name = \request()->get('name');
        $Email = \request()->get('email');

        $UserModel = User::where('id', $id) -> first();
        $UserModel->name = $Name;
        $UserModel->email = $Email;
        $UserModel ->save();


        return $this->index();
    }

    public function DeleteUser(int $id) {
        $UserModel = User::where('id', $id) -> first();
        $UserModel -> delete();
        return $this->index();
    }

}
