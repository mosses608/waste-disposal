@if (session()->has('updated_profile_pic'))
<div class="loggedin-card-message">
    <p>{{session('updated_profile_pic')}}</p>
</div>
@endif
