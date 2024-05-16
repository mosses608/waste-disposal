@if (session()->has('customer_edited'))

<div class="loggedin-card-message">
    <p>{{session('customer_edited')}}</p>
</div>

@endif
