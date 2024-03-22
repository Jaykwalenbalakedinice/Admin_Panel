@extends('layout.app')

@section('headerTitle')
    <h1 class="m-0">Dashboard</h1>
@endsection

@section('active')
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <i class="fa-solid fa-chart-simple" style="margin-left: 5px; margin-right: 7px;"></i>
            <p>
                Dashboard
                <i class="right fas"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('admin.generalReport') }}" class="nav-link">
            <i class="fa-solid fa-download" style="margin-left: 5px; margin-right: 7px;"></i>
            <p>
                General Report
                <i class="right fas"></i>
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="http://20.20.23.72/client-log-master/public/clientLogs/applicationForm" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Application Form
            </p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="http://20.20.23.72/client-log-master/public/clientLogs" class="nav-link">
            <i class="fa-solid fa-table" style="margin-left: 5px; margin-right: 7px;"></i>
            <p>
                Client Logs
            </p>
        </a>
    </li>
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid" style="width: 1800px; height: 500px;">
            <div class="row d-flex">
                <div class="card card-danger col-12 col-lg-7 h-50 P-0">
                    <div class="card-header">
                        <h3 class="card-title">Purposes</h3>
                    </div>
                    <div class="card-body">
                        <canvas class="d-flex justify-content-center mb-4" id="purposeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('content2')
@endsection

@section('additionalScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        window.onload = function() {
            var ctx = document.getElementById('purposeChart').getContext('2d');

            var data = {
                labels: ['CAV', 'ROD', 'SOD', 'Appointment', 'Inquiry',
                    'Interview', 'Training', 'Meeting', 'Bidding', 'Payment', 'Pick-up cheque'
                ],
                datasets: [{
                    data: [
                        {{ $clientPurpose->CAV_count }},
                        {{ $clientPurpose->ROD_count }},
                        {{ $clientPurpose->SOD_count }},
                        {{ $clientPurpose->Appointment_count }},
                        {{ $clientPurpose->Inquiry_count }},
                        {{ $clientPurpose->Interview_count }},
                        {{ $clientPurpose->Training_count }},
                        {{ $clientPurpose->Meeting_count }},
                        {{ $clientPurpose->Bidding_count }},
                        {{ $clientPurpose->Payment_count }},
                        {{ $clientPurpose->PC_count }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.80)',
                        'rgba(255, 159, 64, 0.80)',
                        'rgba(255, 205, 86, 0.80)',
                        'rgba(75, 192, 192, 0.80)',
                        'rgba(54, 162, 235, 0.80)',
                        'rgba(153, 102, 255, 0.80)',
                        'rgba(201, 203, 207, 0.80)',
                        'rgba(42, 132, 132, 0.80)',
                        'rgba(255, 159, 64, 0.80)',
                        'rgba(255, 205, 86, 0.80)',
                        'rgba(75, 192, 192, 0.80)'
                    ],

                }]
            };

            // Configure options
            var options = {
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0,
                            fontSize: 10
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            };

            // Create the chart
            var purposeChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        }
    </script>
