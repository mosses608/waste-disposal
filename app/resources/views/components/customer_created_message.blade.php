@if (session()->has('customer_created'))

<div class="loggedin-card-message">
    <p>{{session('customer_created')}}</p>
</div>

@endif
