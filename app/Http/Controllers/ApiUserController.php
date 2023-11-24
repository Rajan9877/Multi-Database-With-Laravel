<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiUserController extends Controller
{
    public function fetchUser(){
        $users = User::all();
        return $users;
    }
}
