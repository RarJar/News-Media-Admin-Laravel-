<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    //Login Page
    public function loginPage(){
        return view('auth.login');
    }

    //Register Page
    public function registerPage(){
        return view('auth.register');
    }
}
