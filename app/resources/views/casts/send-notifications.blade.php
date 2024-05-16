@extends('casts.cast-layout')

@section('content')
<br><br><br>

@include('partials.cast-card')

<x-notification_sent />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Customer / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="payment-info-container-data">
        <button class="load-notification-form" onclick="loadForm()">Load Form</button><br><br>
        <form action="/notifications" method="POST" class="notification-context-formulae-lgx">
            @csrf

            <input type="hidden" name="full_name" id="" value="{{Auth::guard('customer')->user()->full_name}}">

            <input type="hidden" name="phone_number" id="" value="{{Auth::guard('customer')->user()->phone_number}}">

            <input type="hidden" name="profile" id="" value="{{Auth::guard('customer')->user()->profile}}">

            @foreach ($transactions as $payment)
            @if($payment->email == Auth::guard('customer')->user()->email)

            <input type="hidden" name="payment_status" id="" value="{{$payment->status}}">

            <input type="hidden" name="date_paid" id="" value="{{$payment->created_at}}">

            @endif
            @endforeach

            <textarea name="notification_content" id="" placeholder="What is your notification?"></textarea><br>
            <button type="submit">Submit</button><br><br>
        </form>
    </div>
    </div>
</center>
@endsection
