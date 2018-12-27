<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
USE App\User;

class UsersController extends Controller
{
    public function index(Request $request){ 
        //ACCEDEMOS A LA BASE DE DATOS//
        $users = User::all();  // equivale a SELECT * FROM users
        //return $users;
        return view("users.index")->with('users', $users);
    }

    public function getUser(Request $request, $id){
        //ACCEDEMOS A LA BASE DE DATOS//
        $user = User::find($id);  // equivale a SELECT * FROM users where user=$id
        return $user;
    }
}
