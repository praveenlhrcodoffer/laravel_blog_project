<?php

namespace App\Http\Controllers;

use index;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class AuthController extends Controller
{

    // register method -------------------------------------------------
    public function registerUser(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:5', // |>password should be of min length 5
            'confirm_password' => 'required|string|same:password', //|> Validation rule to match passwords
        ], [
            'confirm_password.same' => 'password and confirm password should match'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();

            return Redirect::back()->withErrors($errors);
            // OR
            // return redirect()->back()->withErrors($errors);

        }

        $user = User::create([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('posts.home');
    }


    // login method ------------------------------------------------------------


    // public function loginUser(Request $request)
    // {
    //     // Directly validate the request data and automatically redirect back with errors
    //     $validatedData = $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string',
    //     ]);

    //     // Attempt to authenticate the user
    //     if (Auth::attempt($validatedData)) {
    //         // Authentication passed, redirect to the intended page with a default fallback
    //         return redirect()->route('posts.home');
    //     }

    //     // If authentication failed, redirect back to the login form with an error message
    //     // No need to explicitly check if user exists in this scenario
    //     return redirect('user/login')->withErrors(
    //         [
    //             // 'email' => 'The provided credentials do not match our records.',
    //             // 'password' => 'Invalid password',
    //             'msg' => 'Invalid credentials',
    //         ]
    //     );
    // }


    public function loginUser(Request $request)
    {
        //|> 1. First check if email and password are present.
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return Redirect::back()->withErrors($errors);
        }

        $validatedData = $validator->validated();
        // dd($validatedData);

        $user = User::where('email', $validatedData['email'])->first();

        if (!$user) {
            return Redirect::back()->withErrors(['msg' => 'User not yet registered !!']);
        } else {

            $authRes = Auth::attempt([
                'email' => $validatedData['email'],
                'password' => $validatedData['password']
            ]);
            // Auth::login($user);
            if ($authRes) {
                return redirect()->route('posts.home');
                // return Redirect::back();
            } else {
                return redirect('user/login')->withErrors(['msg' => 'Invalid Password']);
            }
        }
    }

    public function logoutUser(Request $request)
    {
        $user = Auth::user();

        Auth::logout();
        return Redirect::back();
        // return redirect()->route('posts.home');
    }
}
