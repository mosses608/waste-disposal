@if (session()->has('exists'))

<div class="loggedin-card-message">
    <p>{{session('exists')}}</p>
</div>

@endif
