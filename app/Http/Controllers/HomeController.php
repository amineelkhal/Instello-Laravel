<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $this->validate($request, [
            'firstname' => 'required',
            'lastname' => 'required',
            'description' => 'required'
        ]);

        //2 - GET USER
        $user = User::find( auth()->user()->id );

        //3 - CHECK IF PICTURE SELECTED
        $fileSelected = false;
        if ( $request->file('picture') ){

            $fileName = $request->file('picture')->getClientOriginalName();
            $size = sizeof(explode(".", $fileName));
            $fileExt = explode(".", $fileName)[ $size - 1 ];
            $finalFileName = auth()->user()->id . "." . $fileExt;
            $request->file('picture')->storeAs('profiles', $finalFileName, 'mylocal');

            $user->userpicture = $finalFileName;
            $fileSelected = true;

        }

        //dd( $user );

        //4 - CHANGE IF INFO UPDATED
        if ( $user->firstname != $request->firstname || $user->lastname != $request->lastname || $user->description != $request->description || $fileSelected ){

            //5 - CHANGE USER INFO
            $user->firstname = $request->firstname;
            $user->lastname = $request->lastname;
            $user->description = $request->description;

            //dd( "Ok" );
            $user->save();
            return back()->with('status', 'Informations updated ...');
        } else{
        //6 - GO BACK TO PREVIOUS PAGE
            return back();
        }

    }

}
