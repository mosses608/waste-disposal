<div class="side-menus-menu">

    <a href="/admin-dashboard"><i class="fa fa-home"></i> <em class="unsigned00">Dashboard</em></a>
    <a href="#" onclick="showCustomerMgt()"><i class="fas fa-users"></i> <em class="unsigned1">Customers Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="customer-mgt-sub-menu">
        <a href="/register-customer"><i class="fas fa-chevron-right"></i> <em class="unsigned10">Add Customer</em></a>
        <a href="/view-customers"><i class="fas fa-chevron-right"></i> <em class="unsigned11">View Customer <span style="color:#0000FF;">({{count($customerss)}})</span></em></a>
    </div>
    <a href="#" onclick="showPaymentMgt()"><i class="fa fa-dollar"></i> <em class="unsigned2">Payments Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="payment-mgt-sub-menu">
        <a href="/transaction-processing"><i class="fas fa-chevron-right"></i> <em class="unsigned20">Make Payment</em></a>
        <a href="/view-payments"><i class="fas fa-chevron-right"></i> <em class="unsigned21">View Payments <span style="color:#0000FF;">({{count($transactionss)}})</span></em></a>
    </div>
    <a href="#" onclick="showNotificationMgt()"><i class="fa fa-bell"></i> <em class="unsigned3">Notifications Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="notif-mgt-sub-menu">
        <a href="/view-notifications"><i class="fas fa-chevron-right"></i> <em class="unsigned30">View Notifications <span style="color:#0000FF;">({{count($notificationss)}})</span></em></a>
    </div>
    <a href="#" onclick="showNewsMgt()"><i class="fa fa-comment"></i> <em class="unsigned4">News Management</em> <i class="fas fa-angle-down"></i></a>
    <div class="new-mgt-sub-menu">
        <a href="/post-news-updates"><i class="fas fa-chevron-right"></i> <em class="unsigned40">Post News</em></a>
    </div>
    <form action="/logout" method="POST" class="logout-side-menu">
        @csrf
        <button type="submit" class="invalidateToken"><i class="fa fa-sign-out"></i> <em class="unsigned5">Logout</em></button>
    </form>


</div>
