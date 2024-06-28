@extends('casts.cast-layout')

@section('content')
<br><br><br>
@include('partials.cast-card')

<x-customer_updated />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">
        <div class="left-profile-data">
            @if (Auth::guard('customer')->user()->profile =="")
            <form action="/customers/editpict/{{Auth::guard('customer')->user()->id}}" method="post" class="edit-profilr-picture" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <br><br>
                <input type="file" name="profile" id=""><br><br>
                <button type="submit">Update</button>
            </form>
            @else
            <img src="{{Auth::guard('customer')->user()->profile ? asset('storage/' . Auth::guard('customer')->user()->profile) : asset('assets/images/profile.png')}}" alt="My Profile">
            @endif
        </div>
        <div class="right-profike-data">
            <form action="/customers/editdata/{{Auth::guard('customer')->user()->id}}" method="POST" class="edit-other-profile-data">
                @csrf
                @method('PUT')
                <div class="left-side-comp">
                    <label for="">Full Name</label><br>
                    <input type="text" name="full_name" id="" value="{{Auth::guard('customer')->user()->full_name}}"><br><br>
                    <label for="">Phone Number</label><br>
                    <input type="number" name="phone_number" id="" value="{{Auth::guard('customer')->user()->phone_number}}"><br><br>
                    <label for="">District</label><br>
                    <input type="text" name="district" id="" value="{{Auth::guard('customer')->user()->district}}"><br><br>
                    <label for="">Street</label><br>
                    @if (Auth::guard('customer')->user()->street !="")
                    <input type="text" name="street" id="" value="{{Auth::guard('customer')->user()->street}}"><br><br>
                    @else
                    <input type="text" name="street_n" id="" value="{{Auth::guard('customer')->user()->street_n}}"><br><br>
                    @endif
                </div>


                <div class="right-side-comp">
                    <label for="">House Number</label><br>
                    <input type="text" name="house_number" id="" value="{{Auth::guard('customer')->user()->house_number}}"><br><br>
                    <label for="">Email</label><br>
                    <input type="email" name="email" id="" value="{{Auth::guard('customer')->user()->email}}"><br><br>
                    <label for="">Username</label><br>
                    <input type="text" name="username" id="" value="{{Auth::guard('customer')->user()->username}}"><br><br>
                    <label for="">Password</label><br>
                    <input type="text" name="password" id="" value="{{Auth::guard('customer')->user()->password}}"><br><br>
                    <button type="submit">Update Data</button><br><br>
                </div>
            </form>
        </div>
    </div>



</center>
@endsection
