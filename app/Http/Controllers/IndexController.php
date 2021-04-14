<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class IndexController extends Controller
{

    public function __construct(){
        $this->middleware(['guest']);
    }

    public function index(){
        return view('login');
    }

    public function register(){
        return view('register');
    }

    public function registerUser(Request $request){

        //1 - FORM VALIDATION
        $this->validate($request, [
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'firstname' => 'required',
            'lastname' => 'required'
        ]);

        //2 - CREATING USER
        User::create([
            'name' => $request->firstname . " ". $request->lastname,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'userpicture' => 'default.png',
            'description' => ''
        ]);

        //3 - AFTER SAVING USER
        //Option 1 : Simple redirection to login page
        //return redirect()->route('index');

        //Option 2 : Authenticate user and redirect to home page
        auth()->attempt( $request->only('email', 'password') );
        return redirect()->route('feed');

    }

}
