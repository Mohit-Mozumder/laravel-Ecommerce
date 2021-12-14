<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class Usercontroller extends Controller
{
    //
    function login(Request $req){
        
        $user= User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password))
        {
            return "Username or password is not matched";
        }

        else{
            $req->session()->put('user',$user);
            return redirect('/');
        }
    }

    function register(Request $req){

        $user= New User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->password=Hash::make($req->password);
        $user->save();
       return Redirect('/login');
        
        }
}