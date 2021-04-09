<?php

namespace App\Http\Controllers;

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


}
