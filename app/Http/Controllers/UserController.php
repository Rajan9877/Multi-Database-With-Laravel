<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    public function index($id){
       // Assuming $userData is an array containing the data you want to insert
    $userData = [
        'name' => 'Priya',
        'email' => 'Priya@gmail.com',
        'password' => Crypt::encryptString('123456'),
    ];

// Insert into the 'users' table using the 'mysql2' connection
    DB::connection('mysql'.$id)->table('users')->insert($userData);

    return "Data Inserted Successfully";
    }

    public function fetch(Request $request){
        $selectedDatabase = $request->input('database');
        $userData = DB::connection($selectedDatabase)->table('users')->get();
        $html = '';
        foreach ($userData as $user) {
            $html .= '<tr>';
            $html .= '<td>' . $user->name . '</td>';
            $html .= '<td>' . $user->email . '</td>';
            $html .= '<td>' . Crypt::decryptString($user->password) . '</td>';
            $html .= '</tr>';
        }
    
        return $html;
    }
}
