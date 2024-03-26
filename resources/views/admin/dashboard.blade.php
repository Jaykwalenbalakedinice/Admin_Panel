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
                    'Interview', 'Training', 'Meeting', 'Bidding', 'Payment', 'Pick-up cheque',
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
                ['ph-mn', {{$province->MisamisOriental_count}}],
                ['ph-4218', 11],
                ['ph-tt', {{$province->Tawitawi_count}}],
                ['ph-bo', {{$province->Bohol_count}}],
                ['ph-cb', {{$province->Cebu_count}}],
                ['ph-bs', {{$province->Basilan_count}}],
                ['ph-2603', {{$province->ZamboangaSibugay_count}}],
                ['ph-su', {{$province->Sulu_count}}],
                ['ph-aq', {{$province->Antique_count}}],
                ['ph-pl', {{$province->Palawan_count}}],
                ['ph-ro', {{$province->Romblon_count}}],
                ['ph-al', {{$province->Albay_count}}],
                ['ph-cs', {{$province->CamarinesSur_count}}],
                ['ph-6999', 23],
                ['ph-bn', {{$province->Batanes_count}}],
                ['ph-cg', {{$province->Cagayan_count}}],
                ['ph-pn', {{$province->Pangasinan_count}}],
                ['ph-bt', {{$province->Batangas_count}}],
                ['ph-mc', {{$province->MindoroOccidental_count}}],
                ['ph-qz', {{$province->Quezon_count}}],
                ['ph-es', {{$province->EasternSamar_count}}],
                ['ph-le', {{$province->Leyte_count}}],
                ['ph-sm', {{$province->WesternSamar_count}}],
                ['ph-ns', {{$province->NorthernSamar_count}}],
                ['ph-cm', {{$province->Camiguin_count}}],
                ['ph-di', {{$province->SurigaoDelNorte_count}}],
                ['ph-ds', {{$province->DavaoOccidental_count}}],
                ['ph-6457', 37],
                ['ph-6985', 38],
                ['ph-ii', {{$province->Iloilo_count}}],
                ['ph-7017', 40],
                ['ph-7021', 41],
                ['ph-lg', {{$province->Laguna_count}}],
                ['ph-ri', {{ $province->Rizal_count }}],
                ['ph-ln', {{$province->LanaoDelNorte_count}}],
                ['ph-6991', 45],
                ['ph-ls', {{$province->LanaoDelSur_count}}],
                ['ph-nc', {{$province->NorthCotabato_count}}],
                ['ph-mg', {{$province->Maguindanao_count}}],
                ['ph-sk', {{$province->SultanKudarat_count}}],
                ['ph-sc', {{$province->SouthCotabato_count}}],
                ['ph-sg', {{$province->Sarangani_count}}],
                ['ph-an', {{$province->AgusanDelNorte_count}}],
                ['ph-ss', {{$province->SurigaoDelSur_count}}],
                ['ph-as', {{$province->AgusanDelSur_count}}],
                ['ph-do', {{$province->DavaoOriental_count}}],
                ['ph-dv', {{$province->DavaoDelNorte_count}}],
                ['ph-bk', {{$province->Bukidnon_count}}],
                ['ph-cl', {{$province->CompostelaValley_count}}],
                ['ph-6983', 59],
                ['ph-6984', 60],
                ['ph-6987', 61],
                ['ph-6986', 62],
                ['ph-6988', 63],
                ['ph-6989', {{$province->DavaoDelSur_count}}],
                ['ph-6990',],
                ['ph-6992', 66],
                ['ph-6995', 67],
                ['ph-6996', {{$municipality->PuertoPrincesa_count}}],
                ['ph-6997', 69],
                ['ph-6998', 70],
                ['ph-nv', {{$province->NuevaVizcaya_count}}],
                ['ph-7020', 72],
                ['ph-7018', 73],
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
                ['ph-zs', {{$province->ZamboangaDelSur_count}}],
                ['ph-nd', {{$province->NegrosOccidental_count}}],
                ['ph-zn', {{$province->ZamboangaDelNorte_count}}],
                ['ph-md', {{$province->MisamisOccidental_count}}],
                ['ph-ab', {{$province->Abra_count}}],
                ['ph-2658', {{$province->Apayao_count}}],
                ['ph-ap', {{$province->Kalinga_count}}],
                ['ph-au', {{$province->Aurora_count}}],
                ['ph-ib', {{$province->Isabela_count}}],
                ['ph-if', {{$province->Ifugao_count}}],
                ['ph-mt', {{$province->MountainProvince_count}}],
                ['ph-qr', {{$province->Quirino_count}}],
                ['ph-ne', {{$province->NuevaEcija_count}}],
                ['ph-pm', {{$province->Pampanga_count}}],
                ['ph-ba', {{$province->Bataan_count}}],
                ['ph-bg', {{$province->Benguet_count}}],
                ['ph-zm', {{$province->Zambales_count}}],
                ['ph-cv', {{$province->Cavite_count}}],
                ['ph-bu', {{$province->Bulacan_count}}],
                ['ph-mr', {{$province->MindoroOriental_count}}],
                ['ph-sq', {{$province->Siquijor_count}}],
                ['ph-gu', {{$province->Guimaras_count}}],
                ['ph-ct', {{$province->Catanduanes_count}}],
                ['ph-mb', {{$province->Masbate_count}}],
                ['ph-mq', {{$province->Marinduque_count}}],
                ['ph-bi', {{$province->Biliran_count}}],
                ['ph-sl', {{$province->SouthernLeyte_count}}],
                ['ph-nr', {{$province->NegrosOriental_count}}],
                ['ph-ak', {{$province->Aklan_count}}],
                ['ph-cp', {{$province->Capiz_count}}],
                ['ph-cn', {{$province->CamarinesNorte_count}}],
                ['ph-sr', {{$province->Sorsogon_count}}],
                ['ph-in', {{$province->IlocosNorte_count}}],
                ['ph-is', {{$province->IlocosSur_count}}],
                ['ph-tr', {{$province->Tarlac_count}}],
                ['ph-lu', {{$province->LaUnion_count}}]
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
