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


    <div class="payment-info-container-data mt-10 p-10">
        <form action="/transactions" method="POST" class="pay-by-paypal">
            @csrf
            <input type="hidden" name="payer_email" id="" value="{{$customer->email}}">
            <label for="">Click to Pay by Paypal</label><br><br>
            <input type="hidden" name="amount" id="" value="2000">
            <button type="submit" class="pay-by-paypal-button"><i class="fa fa-paypal"></i></button><br>
        </form>

        <form action="/payments" method="POST" class="pay-by-azam-pay">
            @csrf
            <input type="hidden" name="amount" id="" value="4000">
            <input type="hidden" name="externalId" id="" value="100">
            <label for="">Click to pay by Azampay</label><br><br>
            <input type="hidden" name="accountNumber" id="" value="{{$customer->phone_number}}">
            <button type="submit" class="pay-by-paypal-button">Azam pay</button><br>
        </form>

        <br><br><br><br><br>


        <!--<div class="alternative-pay-non-fixed-amount">
            <form action="/transactions" method="POST" class="pay-by-paypal-non-fixed">
                <label for="">Amount Required</label><br>
                <input type="number" name="amount_paid" id="" placeholder="Enter correct amount"><br><br>
                <button type="submit"><i class="fa fa-paypal"></i></button>
            </form>
        </div>-->

    </div>

</center>
@endsection
