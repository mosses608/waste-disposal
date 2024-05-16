@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />

<x-customer_deleted_message />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">

        @if (count($customers) == 0)

        <p>Nothing to show here!</p>

        @else

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
                <th>Action</th>
            </tr>

            @foreach ($customers as $customer)
            <tr>
                <td>{{$customer->full_name}}</td>
                <td>{{$customer->phone_number}}</td>
                <td>{{$customer->district}}</td>

                @if ($customer->street !='')
                <td>{{$customer->street}}</td>
                @elseif($customer->street =='')
                <td>{{$customer->street_n}}</td>
                @endif

                <td>{{$customer->house_number}}</td>
                <td>{{$customer->registration_date}}</td>
                @if ($customer->email == '')
                <td>No email</td>
                @else
                <td>{{$customer->email}}</td>
                @endif
                <td>{{$customer->username}}</td>
                <td><a href="/customer-account/{{$customer->id}}"><i class="fa fa-eye"></i></a></td>
            </tr>
            @endforeach
        </table>

        @endif
<br>
        <div class="paginate-builder-component">
            {{$customers->links()}}
        </div>
    </div>

</center>
@endsection
