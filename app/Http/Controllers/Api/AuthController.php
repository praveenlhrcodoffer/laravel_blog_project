<?php

namespace App\Http\Controllers\Api;

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

        $request->validate([
            'fullname' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:5', // Ensure minimum password length
            'confirm_password' => 'required|string|same:password', // Validation rule to match passwords
        ], [
            'confirm_password.same' => 'The password confirmation does not match.',
        ]);


        if (User::where('email', $request->email)->exists()) {
            return response()->json(['error' => 'User already exists'], 409); // 409 Conflict
        }


        $user = new User([
            'fullname' => $request->fullname,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($user->save()) {
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->plainTextToken;

            return redirect()->route('posts.home', ['accessToken' => $token]);
        } else {
            return response()->json(['error' => 'Provide proper details']);
        }
    }


    // login method -------------------------------------------------
    public function loginUser(Request $request)
    {

        //|> 1. First check if email and password are present.
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);


        //|> $validator varible will contain the response. Calling the ->fails() method
        //|> will check if there was any error, if yes then return error

        if ($validator->fails()) {
            $errors = $validator->errors();
            return  response()->json(['errors' => $errors], 400);
        }


        //|> If everything above is ok then get the data that was validated using validated() method.
        $validatedData = $validator->validated();
        //|> Now check the authentication.
        $authRes = Auth::attempt($validatedData);

        // dd($validator->validated(), $authRes);

        // dd(Auth::check(), Auth::attempt(($validatedData)));

        if ($authRes) {

            return redirect()->route('posts.home');
        }
    }

    public function logoutUser(Request $request)
    {
        Auth::logout();

        // $request->session()->invalidate();

        // $request->session()->regenerateToken();
        $request->user()->tokens()->delete(); // Revoke all user tokens
        dd(Auth::check());
        // return redirect()->route('posts.home');
    }
}
