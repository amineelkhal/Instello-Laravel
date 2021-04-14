@extends('layouts.homeLayout')
@section('title', 'Settings')
@section('css')
    <style>

    </style>
@endsection

@section('content')

    <div class="container m-auto">

        <h1 class="text-2xl leading-none text-gray-900 tracking-tight mt-3"> Account Setting </h1>
        <ul class="mt-5 -mr-3 flex-nowrap lg:overflow-hidden overflow-x-scroll uk-tab">
            <li class="uk-active"><a href="#">General</a></li>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Notification</a></li>
            <li><a href="#">Social links</a></li>
            <li><a href="#">Billing</a></li>
            <li><a href="#">Security</a></li>
        </ul>

        <div class="grid lg:grid-cols-3 mt-12 gap-8">
            <div>
                <h3 class="text-xl mb-2"> Basic</h3>
            </div>
            <div class="bg-white rounded-md lg:shadow-lg shadow col-span-2">
                <form action="{{route('updateUser')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-2 gap-3 lg:p-6 p-4">
                    <div>
                        <label for=""> First name</label>
                        <input type="text" name="firstname" value="{{ auth()->user()->firstname }}" placeholder="Your name.." class="shadow-none bg-gray-100" style="@error('firstname') border:1px solid red @enderror">
                        @error('firstname')
                        <div class="uk-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for=""> Last name</label>
                        <input type="text" name="lastname" value="{{ auth()->user()->lastname }}" placeholder="Your name.." class="shadow-none bg-gray-100" style="@error('lastname') border:1px solid red @enderror">
                        @error('lastname')
                        <div class="uk-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="">Email</label>
                        <input type="text" disabled value="{{ auth()->user()->email }}" class="shadow-none bg-gray-100">
                    </div>
                    <div class="col-span-2">
                        <label for="about">About me</label>
                        <textarea id="about" name="description" style="padding:20px; resize:none;  @error('description') border:1px solid red @enderror" rows="3" class="shadow-none bg-gray-100">{{ auth()->user()->description }}</textarea>
                        @error('description')
                        <div class="uk-text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-span-2">
                        <label for="picture">
                            <img style="max-width:100px;" src="assets/images/profiles/{{ auth()->user()->userpicture }}" />
                        </label>
                        <input type="file" id="picture" name="picture" style="display:none;" />
                        <input type="button"  id="pictureBtn" class="button bg-blue-700" value="Browse" />
                    </div>
                </div>

                <div class="bg-gray-10 p-6 pt-0 flex justify-end space-x-3">
                    <button type="reset" class="p-2 px-4 rounded bg-gray-50 text-red-500"> Cancel </button>
                    <button type="submit" class="button bg-blue-700"> Save </button>
                </div>
                </form>

            </div>

        </div>

    </div>

@endsection

@section('js')

@if ( session('status') )
<script>
UIkit.notification({message: '{{ session("status") }}', status: 'success'});
</script>
@endif

<script>
    $("#pictureBtn").click(function(){
        $("#picture").click();
    })
</script>


@endsection
