@if (session()->has('error'))

<div class="loggedin-card-message">
    <p style="color: red;">{{session('error')}}</p>
</div>

@endif
