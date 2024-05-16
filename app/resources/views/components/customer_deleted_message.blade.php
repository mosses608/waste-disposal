@if (session()->has('delete_message'))

<div class="loggedin-card-message">
    <p>{{session('delete_message')}}</p>
</div>

@endif
