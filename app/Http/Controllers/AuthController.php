<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function signUp()
    {
    }
    public function showSignUp()
    {
        return view('auth.register');
    }
}
