@extends('casts.cast-layout')

@section('content')
<br><br><br>
@include('partials.cast-card')


<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">

        @foreach ($transactions as $payment)

        @endforeach

        @if ($payment->phone_number != Auth::guard('customer')->user()->phone_number)
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
            </tr>

            @foreach ($transactions as $transaction)
            <tr>
                @if ($transaction->email == Auth::guard('customer')->user()->email)
                <td>{{Auth::guard('customer')->user()->full_name}}</td>
                <td>{{Auth::guard('customer')->user()->phone_number}}</td>
                <td>{{Auth::guard('customer')->user()->email}}</td>
                <td>{{Auth::guard('customer')->user()->district}},
                     @if (Auth::guard('customer')->user()->street != "")
                     {{Auth::guard('customer')->user()->street}}
                     @else
                     {{Auth::guard('customer')->user()->street_n}}
                    @endif
            </td>
                <td>{{$transaction->amount}}</td>
                <td>{{$transaction->status}}</td>
                <td>{{$transaction->created_at}}</td>
                @endif
            </tr>
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
