<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{

    public function __construct(){
        $this->middleware(['auth']);
    }

    public function index(){
        $posts = Post::paginate(10);
        return view('feed', ['currentpage'=>'feed', 'posts'=>$posts]);
    }

    public function messages(){
        return view('messages', ['currentpage'=>'messages']);
    }

    public function profile(){
        return view('profile', ['currentpage'=>'profile']);
    }

    public function settings(){
        return view('settings', ['currentpage'=>'settings']);
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

    public function addpost(Request $request){
        // 1 - Validation
        $this->validate($request , [
            'text' => 'required'
        ]);

        //dd( $request->file('picture') );
        $fileName = $request->file('picture')->getClientOriginalName();
        $size = sizeof(explode(".", $fileName));
        $fileExt = explode(".", $fileName)[ $size - 1 ];
        $finalFileName = auth()->user()->id . time() . "." . $fileExt;
        $request->file('picture')->storeAs('posts', $finalFileName, 'mylocal');

        $post = Post::create([
            'user_id' => auth()->id(),
            'text' => $request->text,
            'picture' => $finalFileName,
            'likes' => 0
        ]);

        if ( $post ){
            return back()->with('success', 'Post created...');
        }
        else{
            return back()->with('error', 'Error while creating post');
        }

    }

}
