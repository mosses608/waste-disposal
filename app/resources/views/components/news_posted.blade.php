@if (session()->has('news_posted'))

<div class="loggedin-card-message">
    <p>{{session('news_posted')}}</p>
</div>

@endif
