@if (session()->has('logout_flash_message'))

<div class="loggedin-card-message">
    <p>{{session('logout_flash_message')}}</p>
</div>

@endif
