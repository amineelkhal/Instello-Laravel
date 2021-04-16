<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestController extends Controller
{
    public function hello(){
        print "Hello from controller";
    }

    public function create(){
        $user = User::create([
            'email'=>'test@example.com',
            'password'=>Hash::make('123456'),
            'name' => 'Tom'
        ]);
        dd($user);
    }


    public function testpost(){

        $posts = Post::paginate(10); // SELECT * FROM POSTS
        //print_r( $posts );
        return view('test', ['posts'=>$posts]);

    }


}
