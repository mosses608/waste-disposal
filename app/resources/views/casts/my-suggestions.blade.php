@extends('casts.cast-layout')

@section('content')
<br><br><br>
@include('partials.cast-card')


<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">

    </div>



</center>
@endsection
