<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function login(Request $request){

        //1- INPUT VALIDATION
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //dd($request->remember);

        //2- CHECK USER CREDENTIALS
        if ( !auth()->attempt($request->only('email', 'password'), $request->remember) ){
            return back()->with('status', 'Check your login or password');
        }

        //3- REDIRECT USERS
        return redirect()->route('feed');

    }

    public function logout(){
        auth()->logout();
        return redirect()->route('index');
    }
}
