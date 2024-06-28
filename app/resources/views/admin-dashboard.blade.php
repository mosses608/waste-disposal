@extends('admin-layout')


@section('content')
<br><br><br>
@include('partials.admin-card')

<x-lgin-message />

<x-user_created />

<x-user-exists />

<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>
    <div class="ajax-bod-container">
        <div class="level-zxy-cont">
            <i class="fas fa-users"></i>
            <br>
            <h1><span>{{count($customers)}}</span> @if(count($customers)== 1) Customer @else Customers  @endif</h1><br>
            <a href="/view-customers" class="more-viewable"><span>&#8594;</span> View More</a>
        </div>

        <div class="report-generate-ajax">

            <a href="/generate-report"><i class="fas fa-bar-chart"></i>
                <br><h1>Report</h1>
            </a><br>
            <a href="/generate-report" class="more-viewable"><span>&#8594;</span> View More</a>
        </div>
    </div>
<br><br><br><br><br><br><br>
    <div class="graphical-analysis-data">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <canvas id="customerLineChart" width="400" height="180"></canvas>

        <script>
            var ctx = document.getElementById('customerLineChart').getContext('2d');
            var customerLineChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($districts); ?>,
                    datasets: [{
                        label: 'Number of Customers',
                        data: <?php echo json_encode($customerCounts); ?>,
                        fill: false,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true,
                                callback: function(value) {
                                    return Number.isInteger(value) ? value : '';
                                }
                            }
                        }]
                    }
                }
            });
        </script>



    </div>
</center>
@endsection
