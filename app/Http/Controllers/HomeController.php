<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        return view('feed');
    }

    public function messages(){
        return view('messages');
    }

    public function profile(){
        return view('profile');
    }

    public function settings(){
        return view('settings');
    }

    public function updateUser(Request $request){

        //1 - validation
        //dd($request->file('picture'));
        $request->file('picture')->storeAs('profiles', 'test.jpg', 'mylocal');

    }

}
