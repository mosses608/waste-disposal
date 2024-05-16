@if (session()->has('user_created'))

<div class="loggedin-card-message">
    <p>{{session('user_created')}}</p>
</div>

@endif
