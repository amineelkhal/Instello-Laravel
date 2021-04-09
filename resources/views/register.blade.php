@extends('layouts.indexLayout')
@section('title', 'Register page')
@section('content')
<div>
    <div class="lg:p-12 max-w-md max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
        <h1 class="lg:text-3xl text-xl font-semibold mb-6"> Sign in</h1>
        <p class="mb-2 text-black text-lg"> Register to manage your account </p>
        <form action="{{ route('registeruser') }}" method="post">
            @csrf
            <div class="flex lg:flex-row flex-col lg:space-x-2">
                <input type="text" name="firstname" value="{{ old('firstname') }}" placeholder="First Name" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                @error('firstname')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
                <input type="text" name="lastname" value="{{ old('lastname') }}" placeholder="Last Name" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
                @error('lastname')
                    <div class="uk-text-danger">{{ $message }}</div>
                @enderror
            </div>
            <input type="text" name="email" value="{{ old('email') }}" placeholder="Email" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
            @error('email')
                <div class="uk-text-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password" placeholder="Password" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
            @error('password')
                <div class="uk-text-danger">{{ $message }}</div>
            @enderror
            <input type="password" name="password_confirmation" placeholder="Confirm Password" class="bg-gray-200 mb-2 shadow-none  dark:bg-gray-800" style="border: 1px solid #d3d5d8 !important;">
            <div class="flex justify-start my-4 space-x-1">
                <div class="checkbox">
                    <input type="checkbox" id="chekcbox1" checked>
                    <label for="chekcbox1"><span class="checkbox-icon"></span> I Agree</label>
                </div>
                <a href="#"> Terms and Conditions</a>
            </div>
            <button type="submit" class="bg-gradient-to-br from-pink-500 py-3 rounded-md text-white text-xl to-red-400 w-full">Login</button>
            <div class="text-center mt-5 space-x-2">
                <p class="text-base"> Do you have an account? <a href="form-login.html"> Login </a></p>
            </div>
        </form>
    </div>
</div>
@endsection
