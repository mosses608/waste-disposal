@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />


<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="cust-info-container-data mt-10 p-10">

        @if (count($customers) == 0)

        <p>Nothing to show here!</p>

        @else

        <div class="transact-opera-container">
            @foreach ($customers as $customer)
            <div class="data-main-holder">
                <h1>{{$customer->full_name}}</h1>
                <button class="go-to-pay-button"><a href="/payments/{{$customer->id}}">Pay</a></button><br><br>
            </div><br>
            @endforeach
        </div>

        @endif
<br>
        <div class="paginate-builder-component">
            {{$customers->links()}}
        </div>
    </div>

</center>
@endsection
