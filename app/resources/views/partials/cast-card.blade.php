<div class="side-menus-menu">

    <a href="/casts/cast-dashboard"><i class="fa fa-home"></i> <em class="unsigned00">Dashboard</em></a>
    <a href="#" onclick="showPaymentMgt()"><i class="fa fa-dollar"></i> <em class="unsigned2">Payments Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="payment-mgt-sub-menu">
        <a href="/casts/payments"><i class="fas fa-chevron-right"></i> <em class="unsigned20">Make Payments</em></a>
        <a href="/casts/my-payment-history"><i class="fas fa-chevron-right"></i> <em class="unsigned21">Payments History</em></a>
    </div>
    <a href="#" onclick="showNotificationMgt()"><i class="fa fa-bell"></i> <em class="unsigned3">Notifications Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="notif-mgt-sub-menu">
        <a href="/casts/send-notifications"><i class="fas fa-chevron-right"></i> <em class="unsigned30">Send Notifications</em></a>
    </div>
    <a href="#" onclick="showNewsMgt()"><i class="fa fa-comment"></i> <em class="unsigned4">News Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="new-mgt-sub-menu">
        <a href="#"><i class="fas fa-chevron-right"></i> <em class="unsigned40">View News</em></a>
    </div>
    <a href="#" onclick="showCustomerMgt()"><i class="fas fa-box-open"></i> <em class="unsigned1">Suggestions Box</em> <i class="fas fa-angle-down"></i></a>
    <div class="customer-mgt-sub-menu">
        <a href="/casts/my-suggestions"><i class="fas fa-chevron-right"></i> <em class="unsigned10">My Suggestions</em></a>
        <!--<a href="#"><i class="fas fa-chevron-right"></i> <em class="unsigned11">View Customer</em></a>-->
    </div>
    <form action="/logout" method="POST" class="logout-side-menu">
        @csrf
        <button type="submit" class="invalidateToken"><i class="fa fa-sign-out"></i> <em class="unsigned5">Logout</em></button>
    </form>


</div>
