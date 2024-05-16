@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />

<x-outdated_transaction />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">

        @if (count($transactions) == 0)
        <p>No payment history here!</p>
        @else

        <table>
            <tr>
                <th>Full Name</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Location</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            @foreach ($customers as $customer)

            @foreach ($transactions as $transaction)
            <tr>
                @if ($transaction->email == $customer->email)
                <td>{{$customer->full_name}}</td>
                <td>{{$customer->phone_number}}</td>
                <td>{{$customer->email}}</td>
                <td>{{$customer->district}}, {{$customer->street}}</td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->status}}</td>
                <td>{{$transaction->created_at}}</td>
                <td><form action="/transactions/delete_detail/{{$transaction->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-transact-data"><i class="fas fa-trash"></i></button>
                </form></td>
                @endif
            </tr>
            @endforeach

            @endforeach
        </table>
        @endif
    </div>

        <br>
        <div class="pagination-ervice-provider">
            <div class="paginate-builder-component">
                {{$transactions->links()}}
            </div>
        </div>

</center>
@endsection
