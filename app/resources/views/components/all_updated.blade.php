@if (session()->has('all_updated'))

<div class="loggedin-card-message">
    <p>{{session('all_updated')}}</p>
</div>

@endif
