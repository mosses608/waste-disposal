@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-updated_profile_pic />

<x-all_updated />

<x-user_created />

<x-user-exists />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1>My Profile / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="detailed-component-profile">
        <div class="current-user-detailed-lg">
            <img src="{{Auth::guard('web')->user()->profile ? asset('storage/' . Auth::guard('web')->user()->profile) : asset('assets/images/profile.png')}}" alt="My Profile Image">
            @if (Auth::guard('web')->user()->user_role =='1')
            <p><i class="fa fa-check"></i> Admin</p><br>
            @endif
            <p><i class="fa fa-check"></i> Full Name: {{Auth::guard('web')->user()->full_name}}</p>
            <p><i class="fa fa-check"></i> Email: {{Auth::guard('web')->user()->email}}</p>
            <p><i class="fa fa-check"></i> Phone Number: {{Auth::guard('web')->user()->phone_number}}</p>
            <p><i class="fa fa-check"></i> Username: {{Auth::guard()->user()->username}}</p>
        </div>


        <form action="/users/upadateProfilePic/{{Auth::guard('web')->user()->id}}" method="POST" class="update-change-profile-pic" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="">Upload Profile Picture</label><br>
            <input type="file" name="profile" id=""><br><br>
            <button type="submit"><i class="fa fa-edit"></i> Update</button>
        </form>


        <form action="/users/upadateAll/{{Auth::guard('web')->user()->id}}" method="POST" class="edit-change-all-detailed-lgx">
            @csrf
            @method('PUT')
            <label for="">Full Name</label><br>
            <input type="text" name="full_name" id="" value="{{Auth::guard('web')->user()->full_name}}"><br><br>
            <label for="">Email</label><br>
            <input type="email" name="email" id="" value="{{Auth::guard('web')->user()->email}}"><br><br>
            <label for="">Phone Number</label><br>
            <input type="text" name="phone_number" id="" value="{{Auth::guard('web')->user()->phone_number}}"><br><br>
            <label for="">Username</label><br>
            <input type="text" name="username" id="" value="{{Auth::guard('web')->user()->username}}"><br><br>
            <label for="">Password</label><br>
            <input type="text" name="password" id="" value="{{Auth::guard('web')->user()->password}}"><br><br>
            <button type="submit" class="update-all-lgx"><i class="fa fa-edit"></i>Update</button>
        </form>
    </div>
</center>
@endsection
