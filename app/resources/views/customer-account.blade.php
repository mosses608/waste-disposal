@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />

<x-customer_edited />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="cust-info-container-data mt-10 p-10">
        <table>
            <tr>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>District</th>
                <th>Street</th>
                <th>House Number</th>
                <th>Registered on</th>
                <th>Email</th>
                <th>Username</th>
                <th>Edit</th>
                <th>Erase</th>
            </tr>

            <tr>
                <td>{{$customer->full_name}}</td>
                <td>{{$customer->phone_number}}</td>
                <td>{{$customer->district}}</td>
                <td>{{$customer->street}}</td>
                <td>{{$customer->house_number}}</td>
                <td>{{$customer->registration_date}}</td>
                @if ($customer->email == '')
                <td>No email</td>
                @else
                <td>{{$customer->email}}</td>
                @endif
                <td>{{$customer->username}}</td>
                <td onclick="showEditForm()"><button class="load-edit-form"><i class="fa fa-edit"></i></button></td>
                <td><form action="/customer/delete/{{$customer->id}}" method="POST" class="edit-user-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa fa-trash"></i></button>
                </form></td>
            </tr>
        </table>
<br>
        <form action="/customers/editcustomer/{{$customer->id}}" method="POST" class="loaded-edit-form">
            @csrf
            @method('PUT')

            <div class="left-side-component">
            <label for="">Full Name</label><br>
            <input type="text" name="full_name" id="" value="{{$customer->full_name}}"><br><br>


            <label for="">Phone Number</label>
            <input type="number" name="phone_number" id="" value="{{$customer->phone_number}}"><br><br>


            <label for="">District</label>
            <input type="text" name="district" id="" value="{{$customer->district}}"><br><br>


            <label for="">Street</label><br>
            <input type="text" name="street" id="" value="{{$customer->street}}"><br><br>

            </div>

            <div class="right-side-component">

            <label for="">Email</label><br>
            <input type="email" name="email" id="" value="{{$customer->email}}"><br><br>


            <label for="">Username</label><br>
            <input type="text" name="username" id="" value="{{$customer->username}}"><br><br>


            <label for="">Password</label><br>
            <input type="text" name="password" id="" value="{{$customer->password}}"><br><br><br>

            <button type="submit"><i class="fa fa-edit"></i> Edit Data</button><br><br>

            </div>
        </form>

    </div>

</center>
@endsection
