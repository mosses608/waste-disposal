@if (session()->has('message'))

<div class="loggedin-card-message">
    <p>{{session('message')}}</p>
</div>

@endif
