@if (session()->has('outdated_transaction'))

<div class="loggedin-card-message">
    <p>{{session('outdated_transaction')}}</p>
</div>

@endif
