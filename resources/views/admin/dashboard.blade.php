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
        <div class="container-fluid">
            <div class="row d-flex">
                <div class="card card-danger card-outline col-12 col-lg-7 h-50">
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
    <script>
        var ctx = document.getElementById('purposeChart').getContext('2d');

        var data = {
            labels: ['CAV', 'Receiving of Documents', 'Submission of Document', 'Appointment', 'Inquiry', 'Interview', 'Training', 'Meeting', 'Bidding', 'Payment', 'Pick-up cheque'],
            datasets: [{
                label: 'clientPurpose',
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                borderColor: 'rgba(255, 162, 235, 1)',
                borderWidth: 1,
                data: [
                    {{$clientPurpose->CAV_count}},
                    {{$clientPurpose->ROD_count}},
                    {{$clientPurpose->SOD_count}},
                    {{$clientPurpose->Appointment_count}},
                    {{$clientPurpose->Inquiry_count}},
                    {{$clientPurpose->Interview_count}},
                    {{$clientPurpose->Training_count}},
                    {{$clientPurpose->Meeting_count}},
                    {{$clientPurpose->Bidding_count}},
                    {{$clientPurpose->Payment_count}},
                    {{$clientPurpose->PC_count}},
                ],
            }]
        };

        // Configure options
        var options = {
            scales: {
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
    </script>
