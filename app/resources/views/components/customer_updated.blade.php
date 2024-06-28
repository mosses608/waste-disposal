@if (session()->has('customer_updated'))
<div class="loggedin-card-message">
    <p>{{session('customer_updated')}}</p>
</div>
@endif
