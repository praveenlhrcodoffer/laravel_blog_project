<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    // register method -------------------------------------------------
    public function registerUser(Request $request)
    {
        // // dd($request->all());
        // $validator = Validator::make($request->all(), [
        //     'fullname' => 'required|string',
        //     'email' => 'required|string|email|unique:users,email',
        //     'password' => 'required|string|min:5', // |>password should be of min length 5
        //     'confirm_password' => 'required|string|same:password', //|> Validation rule to match passwords
        // ], [
        //     'confirm_password.same' => 'password and confirm_password should match'
        // ]);


        // if ($validator->fails()) {
        //     $errors = $validator->errors();
        //     dd('Error in registration', $errors->messages());
        //     return  response()->json(['errors' => $errors], 400);
        // }

        // // dd($validator->validate());










        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:5', // |>password should be of min length 5
            'confirm_password' => 'required|string|same:password', //|> Validation rule to match passwords
        ], [
            'confirm_password.same' => 'password and confirm_password should match'
        ]);


        //|> Either use unique:email rule in Validator which will check for unqiue value in table
        //|> or use the below to check if email already exists or not
        // if (User::where('email', $request->email)->exists()) {
        //     dd('User already registered');
        //     return response()->json(['error' => 'User already exists'], 409); // 409 Conflict
        // }

        if ($validator->fails()) {
            $errors = $validator->errors();
            dd('Error in registration', $errors->messages());
            return  response()->json(['errors' => $errors], 400);
        }

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('posts.home');
    }


    // login method -------------------------------------------------
    public function loginUser(Request $request)
    {

        // dd('reched');
        //|> 1. First check if email and password are present.
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        //|> $validator variable will contain the response. Calling the ->fails() method
        //|> will check if there was any error, if yes then return error

        // dd($validator);

        if ($validator->fails()) {
            $errors = $validator->errors();
            dd('request email,password error', $errors);
            return  response()->json(['errors' => $errors->messages()], 400);
        }


        //|> If everything above is ok then get the data that was validated using validated() method.
        $validatedData = $validator->validated();
        //|> Now check the authentication.
        $authRes = Auth::attempt($validatedData);

        // dd($validator->validated(), $authRes);

        // dd(Auth::check(), Auth::attempt(($validatedData)));

        if ($authRes) {
            return redirect()->route('posts.home');
        } else {
            $user = User::where('email', $validatedData['email'])->first();
            if (!$user) {
                return response()->json(['error' => 'User not registered yet'], 404);
            } else {
                return response()->json(['error' => 'Invalid credentials'], 401);
            }
        }
    }

    public function logoutUser(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        return redirect()->route('posts.home');
    }
}
