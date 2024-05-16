@if (session()->has('notification_sent'))

<div class="loggedin-card-message">
    <p>{{session('notification_sent')}}</p>
</div>

@endif
