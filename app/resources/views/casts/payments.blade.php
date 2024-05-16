@extends('casts.cast-layout')

@section('content')
<br><br><br>

@include('partials.cast-card')

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Customer / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="payment-info-container-data">
        <form action="/transactions" method="POST" class="pay-by-paypal">
            @csrf
            <input type="hidden" name="payer_email" id="" value="{{Auth::guard('customer')->user()->email}}">
            <label for="">Click to Pay by Paypal</label><br><br>
            <input type="hidden" name="amount" id="" value="2000">
            <button type="submit" class="pay-by-paypal-button"><i class="fa fa-paypal"></i></button><br>
        </form>

        <form action="/payments" method="POST" class="pay-by-azam-pay">
            @csrf
            <input type="hidden" name="payer_email" id="" value="{{Auth::guard('customer')->user()->email}}">
            <label for="">Click to Pay by Azampay</label><br><br>
            <input type="hidden" name="amount_paid" id="" value="2000">
            <button type="submit" class="pay-by-paypal-button">Azam pay</button><br>
        </form>

    </div>
    </div>
</center>
@endsection
