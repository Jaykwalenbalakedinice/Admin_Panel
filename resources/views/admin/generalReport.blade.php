@extends('layout.app')

@section('headerTitle')
    <h1 class="m-0">General Report</h1>
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
    <a class="nav-link" href="http://20.20.23.72/client-log-master/public/clientLogs/applicationForm"
        class="nav-link">
        <i class="nav-icon fas fa-th"></i>
        <p>
            Application Form
        </p>
    </a>
</li>
<li class="nav-item">
    <a class="nav-link" href="http://20.20.23.72/client-log-master/public/clientLogs"
        class="nav-link">
        <i class="fa-solid fa-table" style="margin-left: 5px; margin-right: 7px;"></i>
        <p>
            Client Logs
        </p>
    </a>
</li>
@endsection

@section('content')

@endsection

@section('content2')

@endsection
