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

        @if (count($notifications) == 0)
        <p>No notification history here!</p>
        @else
        @endif
    </div>

        <br>
        <div class="pagination-ervice-provider">
            <div class="paginate-builder-component">
                {{$notifications->links()}}
            </div>
        </div>

</center>
@endsection
