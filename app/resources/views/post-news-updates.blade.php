@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-user_created />

<x-user-exists />

<x-news_posted />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>


    <div class="cust-info-container-data mt-10 p-10">
        <button class="load-form-new-up" onclick="loadNewsForm()">Load Form</button><br>

        <form action="/news" method="POST" class="post-upd-new" enctype="multipart/form-data">

            @csrf
            <label for="">News Updates Content</label><br>
            <textarea name="news_content" id="" placeholder="Type a message or news updates"></textarea>
            <br>
            <br>
            <label for="">News Attachment</label><br>
            <input type="file" name="attachment" id=""><br><br>
            <button type="submit">Submit Updates</button><br><br>
        </form>
<br>
@if (count($news) == 0)
<p>No news updates here!</p>

@else


            @foreach ($news as $updates)
            <div class="news-contents-lgx">

            <div class="news-content-prox">
                <div class="sub-main-content-lgx">
                    <p>{{$updates->news_content}}</p>
                    <span>{{$updates->created_at}}</span><br>
                </div>
            </div>
            <div class="action-menu-class">
                <button class="view-attachment" onclick="showNewsAttachment()"><i class="fa fa-eye"></i> <span class="hideen-component">Attachment</span></button><br>
                <form action="/news/delete/{{$updates->id}}" method="POST" class="delete-news">
                    @csrf
                    @method('DELETE')
                    <button type="submit"><i class="fa fa-trash"></i> <span class="hideen-component">Delete</span></button>
                </form>
            </div>

            <div class="attachment-componet">
                <img src="{{$updates->attachment ? asset('storage/' . $updates->attachment) : asset('assets/images/profile.png')}}" alt="Mt Attachment">
            </div>
        </div><br>
            @endforeach


        </div>
        @endif

        <br>
        <div class="pagination-ervice-provider">
            <div class="paginate-builder-component">
                {{$news->links()}}
            </div>
        </div>

</center>
@endsection
