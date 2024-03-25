@extends('layout.app')

@section('additionalStyle')
    <Style>
        .small-box-footer-dropdown {
            background-color: rgba(0, 0, 0, .1);
            color: rgba(255, 255, 255, .8);
            display: block;
            padding: 3px 0;
            position: relative;
            text-align: center;
            text-decoration: none;
            z-index: 10;
        }

        #container {
            height: 500px;
            min-width: 310px;
            max-width: 800px;
            margin: 0 auto;
        }

        .loading {
            margin-top: 10em;
            text-align: center;
            color: gray;
        }
    </Style>
@endsection

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
    <div class="row">
        <section class="content mb-5">
            <div class="container" style="width: 2000px; height: 500px;">
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

            <div class="card mt-5">
                <table class="table table-hover table-striped">
                    <thead class="thead bg-danger text-center">
                        <tr>
                            <th>Region</th>
                            <th>Number of Clients</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($regions as $region)
                            <tr>
                                <td>{{ $region->region }}</td>
                                <td>{{ $region->total }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

@endsection

@section('content2')
<section class="container">
    <div id="container"></div>
</section>
@endsection

@section('additionalScript')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.highcharts.com/maps/highmaps.js"></script>
    <script src="https://code.highcharts.com/maps/modules/exporting.js"></script>

    <script>
        var counts = {
            total: ('Total: {{ $clientCount }}'),
            daily: ('Daily: {{ $dailyCount }}'),
            monthly: ('Monthly: {{ $monthlyCount }}'),
            annual: ('Annual: {{ $annualCount }}')
        };
    </script>

    <script>
        $(document).ready(function() {
            $('.dropdown-item').click(function() {
                var countType = $(this).text().toLowerCase();
                var count = counts[countType];
                $('#clientCount').text(count);
            });
        });
    </script>

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

    <script>
        (async () => {

            const topology = await fetch(
                'https://code.highcharts.com/mapdata/countries/ph/ph-all.topo.json'
            ).then(response => response.json());

            // Prepare demo data. The data is joined to map using value of 'hc-key'
            // property by default. See API docs for 'joinBy' for more info on linking
            // data and map.
            const data = [
                ['ph-mn', 10],
                ['ph-4218', 11],
                ['ph-tt', 12],
                ['ph-bo', 13],
                ['ph-cb', 14],
                ['ph-bs', 15],
                ['ph-2603', 16],
                ['ph-su', 17],
                ['ph-aq', 18],
                ['ph-pl', 19],
                ['ph-ro', 20],
                ['ph-al', 21],
                ['ph-cs', 22],
                ['ph-6999', 23],
                ['ph-bn', 24],
                ['ph-cg', 25],
                ['ph-pn', 26],
                ['ph-bt', 27],
                ['ph-mc', 28],
                ['ph-qz', 29],
                ['ph-es', 30],
                ['ph-le', 31],
                ['ph-sm', 32],
                ['ph-ns', 33],
                ['ph-cm', 34],
                ['ph-di', 35],
                ['ph-ds', 36],
                ['ph-6457', 37],
                ['ph-6985', 38],
                ['ph-ii', 39],
                ['ph-7017', 40],
                ['ph-7021', 41],
                ['ph-lg', 42],
                ['ph-ri', 43],
                ['ph-ln', 44],
                ['ph-6991', 45],
                ['ph-ls', 46],
                ['ph-nc', 47],
                ['ph-mg', 48],
                ['ph-sk', 49],
                ['ph-sc', 50],
                ['ph-sg', 51],
                ['ph-an', 52],
                ['ph-ss', 53],
                ['ph-as', 54],
                ['ph-do', 55],
                ['ph-dv', 56],
                ['ph-bk', 57],
                ['ph-cl', 58],
                ['ph-6983', 59],
                ['ph-6984', 60],
                ['ph-6987', 61],
                ['ph-6986', 62],
                ['ph-6988', 63],
                ['ph-6989', 64],
                ['ph-6990', 65],
                ['ph-6992', 66],
                ['ph-6995', 67],
                ['ph-6996', 68],
                ['ph-6997', 69],
                ['ph-6998', 70],
                ['ph-nv', 71],
                ['ph-7020', 72],
                ['ph-7018', 73],
                ['ph-7022', 74],
                ['ph-1852', 75],
                ['ph-7000', 76],
                ['ph-7001', 77],
                ['ph-7002', 78],
                ['ph-7003', 79],
                ['ph-7004', 80],
                ['ph-7006', 81],
                ['ph-7007', 82],
                ['ph-7008', 83],
                ['ph-7009', 84],
                ['ph-7010', 85],
                ['ph-7011', 86],
                ['ph-7012', 87],
                ['ph-7013', 88],
                ['ph-7014', 89],
                ['ph-7015', 90],
                ['ph-7016', 91],
                ['ph-7019', 92],
                ['ph-6456', 93],
                ['ph-zs', 94],
                ['ph-nd', 95],
                ['ph-zn', 96],
                ['ph-md', 97],
                ['ph-ab', 98],
                ['ph-2658', 99],
                ['ph-ap', 100],
                ['ph-au', 101],
                ['ph-ib', 102],
                ['ph-if', 103],
                ['ph-mt', 104],
                ['ph-qr', 105],
                ['ph-ne', 106],
                ['ph-pm', 107],
                ['ph-ba', 108],
                ['ph-bg', 109],
                ['ph-zm', 110],
                ['ph-cv', 111],
                ['ph-bu', 112],
                ['ph-mr', 113],
                ['ph-sq', 114],
                ['ph-gu', 115],
                ['ph-ct', 116],
                ['ph-mb', 117],
                ['ph-mq', 118],
                ['ph-bi', 119],
                ['ph-sl', 120],
                ['ph-nr', 121],
                ['ph-ak', 122],
                ['ph-cp', 123],
                ['ph-cn', 124],
                ['ph-sr', 125],
                ['ph-in', 126],
                ['ph-is', 127],
                ['ph-tr', 128],
                ['ph-lu', 129]
            ];

            // Create the chart
            Highcharts.mapChart('container', {
                chart: {
                    map: topology
                },

                title: {
                    text: ''
                },

                mapNavigation: {
                    enabled: true,
                    buttonOptions: {
                        verticalAlign: 'bottom'
                    }
                },

                colorAxis: {
                    min: 0
                },

                series: [{
                    data: data,
                    name: 'Random data',
                    states: {
                        hover: {
                            color: '#BADA55'
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        format: '{point.name}'
                    }
                }]
            });

        })();
    </script>
