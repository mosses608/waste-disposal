@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />

<x-customer_created_message />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>
    <form action="/customers" method="POST" class="reg-component-container" enctype="multipart/form-data">
        @csrf
        <p>Customers Registration Form</p><br><br>

        <div class="left-side-component">

            <label for="">Full Name</label><br>
            <input type="text" name="full_name" id="" placeholder="Enter customer name" value="{{old('full_name')}}"><br>
            @error('full_name')
            <span>Customer name is required!</span>
            @enderror
            <br>


            <label for="">Phone Number</label><br>
            <input type="number" name="phone_number" id="" placeholder="Enter a valid phone number"><br>
            @error('phone_number')
            <span>Phone number is required!</span>
            @enderror
            <br>


            <label for="">District</label><br>
            <select name="district" id="" class="select-class" onchange="showHiddenInput()">
                <option value="//">Choose district</option>
                <option value="Mjini">Mjini</option>
                <option value="Iyunga">Iyunga</option>
                <!--<option value="Iwambi">Iwambi</option>-->
            </select><br><br>


            <div class="select-address-component" style="display: none;">
                <label for="Street">Street</label><br>
                <select name="street" id="">
                    <option value="">Choose a street</option>
                    <option value="Uhindini">Uhindini</option>
                    <option value="Mabatini">Mabatini</option>
                    <option value="Umoja">Umoja</option>
                </select>
                <br><br>
            </div>

            <div class="selct-di-component-add" style="display: none;">
                <label for="">Street</label><br>
                <select name="street_n" id="">
                    <option value="">Choose a street</option>
                    <option value="Maendeleo">Maendeleo</option>
                    <option value="Ikuti">Ikuti</option>
                    <option value="Inyara">Inyara</option>
                </select><br><br>
            </div>

            <label for="">Profile Picture</label><br>
            <input type="file" name="profile" id="" style="border: none;"><br><br>


            <label for="">House Number</label><br>
            <input type="text" name="house_number" id="" placeholder="Customer's house number"><br>
            <br>


        </div>

        <div class="right-side-component">

            <label for="">Registration Date</label><br>
            <input type="date" name="registration_date" id=""><br>
            @error('registration_date')
            <span>Registration date is required!</span>
            @enderror
            <br>

            <label for="">Do you have an email?</label><br>
            <select name="email_value" id="" class="email-validator" onchange="showHiidenEmailInput()">
                <option value="">Choose option</option>
                <option value="0">I don't have an email</option>
                <option value="1">I have an email</option>
            </select><br><br>

            <div class="email-value-valid" style="display: none;">
                <label for="">Email Address</label><br>
                <input type="email" name="email" id="" placeholder="Enter a valid email">
                <br><br>
            </div>

            <label for="">Username</label><br>
            <input type="text" name="username" id="" placeholder="Enter your username"><br>
            @error('username')
            <span>Username is required!</span>
            @enderror
            <br>

            <label for="">Password</label><br>
            <input type="password" name="password" id="" placeholder="Enter your password"><br>
            @error('password')
            <span>Password is required!</span>
            @enderror
            <br>

            <button type="submit">Submit Registration</button><br><br>
        </div>
    </form>

</center>
@endsection
