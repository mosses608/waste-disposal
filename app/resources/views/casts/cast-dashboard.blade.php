@extends('casts.cast-layout')

@section('content')
<br><br><br>

@include('partials.cast-card')

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Customer / {{Auth::guard('customer')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="new-dashboard-container">
        <h1>News Updates</h1><br><br>
        @foreach ($news as $update)
        <div class="new-updates">
            <div class="sample-latest-updates">
                <p>{{$update->news_content}}</p>
                <span class="time-without-zone">{{$update->created_at}}</span>
            </div>
            <button class="view-attachment-news" onclick="showHiddenAttachment()"><i class="fa fa-eye"></i> Attachment</button><br><br>
            <span class="updated-date-ajax">{{$update->created_at}}</span>

            <div class="attachment-image">
                <img src="{{$update->attachment ? asset('storage/' . $update->attachment) : asset('assets/images/profile.png')}}" alt="Attachment">
            </div>
        </div><br>
        @endforeach

        <div class="paginate-builder-component">
            {{$news->links()}}
        </div>
    </div>
</center>
@endsection
