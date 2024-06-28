@extends('admin-layout')

@section('content')
<br><br><br>

@include('partials.admin-card')


<center>
    <div class="admin-dashboard-container-lgx">
        <h1><i class="fa fa-home"></i> Dashboard / {{Auth::guard('web')->user()->full_name}}</h1> <p class="current_Date">Date</p><br><br>
    </div>

    <div class="controll-option-pannel">
        <button class="print-socument-selected"><i class="fa fa-print"></i></button>
        <form action="/generate-report" method="GET" class="filter-printable-document">
            @csrf
            <input type="date" name="search" id=""><button type="submit">Search</button>
        </form><br><br><br>
        <div class="scrollabe-table-report">
            <h1 class="heading-conponent"></h1>
            <table class="scrollabe-table">
                <tr>
                    <th>Id</th>
                    <th>Customer Name</th>
                    <th>Contact</th>
                    <th>District</th>
                    <th>Street</th>
                    <th>House No</th>
                    <th>Payment Status</th>
                    <th>Date</th>
                </tr>
                @foreach($transactions as $transaction)
                <tr>
                    @foreach($customers as $customer)
                    @if($customer->email == $transaction->email)
                    <td>
                        {{$transaction->id}}
                    </td>
                    <td>
                        {{$customer->full_name}}
                    </td>
                    <td>
                        {{$customer->phone_number}}
                    </td>
                    <td>
                        {{$customer->district}}
                    </td>
                    <td>
                        @if($customer->street !="")
                        {{$customer->street}}
                        @elseif($customer->street_n !="")
                        {{$customer->street_n}}
                        @endif
                    </td>
                    <td>
                        {{$customer->house_number}}
                    </td>
                    <td>
                        {{$transaction->status}}
                    </td>
                    <td>
                        {{$transaction->created_at}}
                    </td>
                    @endif
                    @endforeach
                </tr>
                @endforeach
            </table>

            @if(count($transactions) == 0)
            <br>
                <p>No transaction history found!!!</p>
                <br>
            @endif
        </div>

        <script>

        document.addEventListener('DOMContentLoaded', function () {
            // Add event listener to the print button
            document.querySelector('.print-socument-selected').addEventListener('click', function () {
                // Select the content to be printed
                var contentToPrint = document.querySelector('.scrollabe-table-report').innerHTML;

                //contentToPrint.style.border='2px solid #000';

                // Create a new window for printing
                var printWindow = window.open('', '_blank');

                // Write the content into the new window
                printWindow.document.write('<html><head><title></title></head><body><center>' + contentToPrint + '</center></body></html>');

                document.querySelector('.heading-conponent').textContent="CUSTOMERS TRANSACTION HISTORY";
                // Close the document after printing
                printWindow.document.close();

                // Initiate printing
                printWindow.print();
            });
        });
        </script>
    </div>
</center>
@endsection
