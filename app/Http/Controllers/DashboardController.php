<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $clientPurpose = DB::table('tbl_client_purpose')
            ->selectRaw(
                'SUM(CASE WHEN clientPurpose LIKE "%CAV%" THEN 1 ELSE 0 END) AS CAV_count,
             SUM(CASE WHEN clientPurpose LIKE "%Receiving of Documents%" THEN 1 ELSE 0 END) AS ROD_count,
             SUM(CASE WHEN clientPurpose LIKE "%Submission of Document%" THEN 1 ELSE 0 END) AS SOD_count,
             SUM(CASE WHEN clientPurpose LIKE "%Appointment%" THEN 1 ELSE 0 END) AS Appointment_count,
             SUM(CASE WHEN clientPurpose LIKE "%Inquiry%" THEN 1 ELSE 0 END) AS Inquiry_count,
             SUM(CASE WHEN clientPurpose LIKE "%Interview%" THEN 1 ELSE 0 END) AS Interview_count,
             SUM(CASE WHEN clientPurpose LIKE "%Training%" THEN 1 ELSE 0 END) AS Training_count,
             SUM(CASE WHEN clientPurpose LIKE "%Meeting%" THEN 1 ELSE 0 END) AS Meeting_count,
             SUM(CASE WHEN clientPurpose LIKE "%Bidding%" THEN 1 ELSE 0 END) AS Bidding_count,
             SUM(CASE WHEN clientPurpose LIKE "%Payment%" THEN 1 ELSE 0 END) AS Payment_count,
             SUM(CASE WHEN clientPurpose LIKE "%Pick-up cheque%" THEN 1 ELSE 0 END) AS PC_count',
            )
            ->first();


        $province = DB::table('tbl_clientLogs')
            ->selectRaw(
                'SUM(CASE WHEN province LIKE "%ILOCOS NORTE%" THEN 1 ELSE 0 END) AS IlocosNorte_count,
            SUM(CASE WHEN province LIKE "%ILOCOS SUR%" THEN 1 ELSE 0 END) AS IlocosSur_count,
            SUM(CASE WHEN province LIKE "%LA UNION%" THEN 1 ELSE 0 END) AS LaUnion_count,
            SUM(CASE WHEN province LIKE "%PANGASINAN%" THEN 1 ELSE 0 END) AS Pangasinan_count,

            SUM(CASE WHEN province LIKE "%ABRA%" THEN 1 ELSE 0 END) AS Abra_count,
            SUM(CASE WHEN province LIKE "%APAYAO%" THEN 1 ELSE 0 END) AS Apayao_count,
            SUM(CASE WHEN province LIKE "%BENGUET%" THEN 1 ELSE 0 END) AS Benguet_count,
            SUM(CASE WHEN province LIKE "%IFUGAO%" THEN 1 ELSE 0 END) AS Ifugao_count,
            SUM(CASE WHEN province LIKE "%KALINGA%" THEN 1 ELSE 0 END) AS Kalinga_count,
            SUM(CASE WHEN province LIKE "%MOUNTAIN PROVINCE%" THEN 1 ELSE 0 END) AS MountainProvince_count,

            SUM(CASE WHEN province LIKE "%BATANES%" THEN 1 ELSE 0 END) AS Batanes_count,
            SUM(CASE WHEN province LIKE "%CAGAYAN%" THEN 1 ELSE 0 END) AS Cagayan_count,
            SUM(CASE WHEN province LIKE "%ISABELA%" THEN 1 ELSE 0 END) AS Isabela_count,
            SUM(CASE WHEN province LIKE "%NUEVA VIZCAYA%" THEN 1 ELSE 0 END) AS NuevaVizcaya_count,
            SUM(CASE WHEN province LIKE "%QUIRINO%" THEN 1 ELSE 0 END) AS Quirino_count,

            SUM(CASE WHEN province LIKE "%AURORA%" THEN 1 ELSE 0 END) AS Aurora_count,
            SUM(CASE WHEN province LIKE "%BATAAN%" THEN 1 ELSE 0 END) AS Bataan_count,
            SUM(CASE WHEN province LIKE "%BULACAN%" THEN 1 ELSE 0 END) AS Bulacan_count,
            SUM(CASE WHEN province LIKE "%NUEVA ECIJA%" THEN 1 ELSE 0 END) AS NuevaEcija_count,
            SUM(CASE WHEN province LIKE "%PAMPANGA%" THEN 1 ELSE 0 END) AS Pampanga_count,
            SUM(CASE WHEN province LIKE "%TARLAC%" THEN 1 ELSE 0 END) AS Tarlac_count,
            SUM(CASE WHEN province LIKE "%ZAMBALES%" THEN 1 ELSE 0 END) AS Zambales_count,

            SUM(CASE WHEN province LIKE "%BATANGAS%" THEN 1 ELSE 0 END) AS Batangas_count,
            SUM(CASE WHEN province LIKE "%CAVITE%" THEN 1 ELSE 0 END) AS Cavite_count,
            SUM(CASE WHEN province LIKE "%LAGUNA%" THEN 1 ELSE 0 END) AS Laguna_count,
            SUM(CASE WHEN province LIKE "%QUEZON%" THEN 1 ELSE 0 END) AS Quezon_count,
            SUM(CASE WHEN province LIKE "%RIZAL%" THEN 1 ELSE 0 END) AS Rizal_count,

            SUM(CASE WHEN province LIKE "%MARINDUQUE%" THEN 1 ELSE 0 END) AS Marinduque_count,
            SUM(CASE WHEN province LIKE "%OCCIDENTAL MINDORO%" THEN 1 ELSE 0 END) AS MindoroOccidental_count,
            SUM(CASE WHEN province LIKE "%ORIENTAL MINDORO%" THEN 1 ELSE 0 END) AS MindoroOriental_count,
            SUM(CASE WHEN province LIKE "%PALAWAN%" THEN 1 ELSE 0 END) AS Palawan_count,
            SUM(CASE WHEN province LIKE "%ROMBLON%" THEN 1 ELSE 0 END) AS Romblon_count,

            SUM(CASE WHEN province LIKE "%ALBAY%" THEN 1 ELSE 0 END) AS Albay_count,
            SUM(CASE WHEN province LIKE "%CAMARINES NORTE%" THEN 1 ELSE 0 END) AS CamarinesNorte_count,
            SUM(CASE WHEN province LIKE "%CAMARINES SUR%" THEN 1 ELSE 0 END) AS CamarinesSur_count,
            SUM(CASE WHEN province LIKE "%CATANDUANES%" THEN 1 ELSE 0 END) AS Catanduanes_count,
            SUM(CASE WHEN province LIKE "%MASBATE%" THEN 1 ELSE 0 END) AS Masbate_count,
            SUM(CASE WHEN province LIKE "%SORSOGON%" THEN 1 ELSE 0 END) AS Sorsogon_count,

            SUM(CASE WHEN province LIKE "%AKLAN%" THEN 1 ELSE 0 END) AS Aklan_count,
            SUM(CASE WHEN province LIKE "%ANTIQUE%" THEN 1 ELSE 0 END) AS Antique_count,
            SUM(CASE WHEN province LIKE "%CAPIZ%" THEN 1 ELSE 0 END) AS Capiz_count,
            SUM(CASE WHEN province LIKE "%GUIMARAS%" THEN 1 ELSE 0 END) AS Guimaras_count,
            SUM(CASE WHEN province LIKE "%ILOILO%" THEN 1 ELSE 0 END) AS Iloilo_count,
            SUM(CASE WHEN province LIKE "%NEGROS OCCIDENTAL%" THEN 1 ELSE 0 END) AS NegrosOccidental_count,

            SUM(CASE WHEN province LIKE "%BOHOL%" THEN 1 ELSE 0 END) AS Bohol_count,
            SUM(CASE WHEN province LIKE "%CEBU%" THEN 1 ELSE 0 END) AS Cebu_count,
            SUM(CASE WHEN province LIKE "%NEGROS ORIENTAL%" THEN 1 ELSE 0 END) AS NegrosOriental_count,
            SUM(CASE WHEN province LIKE "%SIQUIJOR%" THEN 1 ELSE 0 END) AS Siquijor_count,

            SUM(CASE WHEN province LIKE "%BILIRAN%" THEN 1 ELSE 0 END) AS Biliran_count,
            SUM(CASE WHEN province LIKE "%EASTERN SAMAR%" THEN 1 ELSE 0 END) AS EasternSamar_count,
            SUM(CASE WHEN province LIKE "%LEYTE%" THEN 1 ELSE 0 END) AS Leyte_count,
            SUM(CASE WHEN province LIKE "%NORTHERN SAMAR%" THEN 1 ELSE 0 END) AS NorthernSamar_count,
            SUM(CASE WHEN province LIKE "%SAMAR (WESTERN SAMAR)%" THEN 1 ELSE 0 END) AS WesternSamar_count,
            SUM(CASE WHEN province LIKE "%SOUTHERN LEYTE%" THEN 1 ELSE 0 END) AS SouthernLeyte_count,

            SUM(CASE WHEN province LIKE "%ZAMBOANGA DEL NORTE%" THEN 1 ELSE 0 END) AS ZamboangaDelNorte_count,
            SUM(CASE WHEN province LIKE "%ZAMBOANGA DEL SUR%" THEN 1 ELSE 0 END) AS ZamboangaDelSur_count,
            SUM(CASE WHEN province LIKE "%ZAMBOANGA SIBUGAY%" THEN 1 ELSE 0 END) AS ZamboangaSibugay_count,

            SUM(CASE WHEN province LIKE "%BUKIDNON%" THEN 1 ELSE 0 END) AS Bukidnon_count,
            SUM(CASE WHEN province LIKE "%CAMIGUIN%" THEN 1 ELSE 0 END) AS Camiguin_count,
            SUM(CASE WHEN province LIKE "%LANAO DEL NORTE%" THEN 1 ELSE 0 END) AS LanaoDelNorte_count,
            SUM(CASE WHEN province LIKE "%MISAMIS OCCIDENTAL%" THEN 1 ELSE 0 END) AS MisamisOccidental_count,
            SUM(CASE WHEN province LIKE "%MISAMIS ORIENTAL%" THEN 1 ELSE 0 END) AS MisamisOriental_count,

            SUM(CASE WHEN province LIKE "%COMPOSTELA VALLEY%" THEN 1 ELSE 0 END) AS CompostelaValley_count,
            SUM(CASE WHEN province LIKE "%DAVAO DEL SUR%" THEN 1 ELSE 0 END) AS DavaoDelSur_count,
            SUM(CASE WHEN province LIKE "%DAVAO ORIENTAL%" THEN 1 ELSE 0 END) AS DavaoOriental_count,
            SUM(CASE WHEN province LIKE "%DAVAO DEL NORTE%" THEN 1 ELSE 0 END) AS DavaoDelNorte_count,
            SUM(CASE WHEN province LIKE "%DAVAO OCCIDENTAL%" THEN 1 ELSE 0 END) AS DavaoOccidental_count,

            SUM(CASE WHEN province LIKE "%SARANGANI%" THEN 1 ELSE 0 END) AS Sarangani_count,
            SUM(CASE WHEN province LIKE "%SOUTH COTABATO%" THEN 1 ELSE 0 END) AS SouthCotabato_count,
            SUM(CASE WHEN province LIKE "%SULTAN KUDARAT%" THEN 1 ELSE 0 END) AS SultanKudarat_count,
            SUM(CASE WHEN province LIKE "%COTABATO (NORTH COT.)%" THEN 1 ELSE 0 END) AS NorthCotabato_count,

            SUM(CASE WHEN province LIKE "%AGUSAN DEL NORTE%" THEN 1 ELSE 0 END) AS AgusanDelNorte_count,
            SUM(CASE WHEN province LIKE "%AGUSAN DEL SUR%" THEN 1 ELSE 0 END) AS AgusanDelSur_count,
            SUM(CASE WHEN province LIKE "%DINAGAT ISLANDS%" OR province LIKE "%SURIGAO DEL NORTE%" THEN 1 ELSE 0 END) AS SurigaoDelNorte_count,
            SUM(CASE WHEN province LIKE "%SURIGAO DEL SUR%" THEN 1 ELSE 0 END) AS SurigaoDelSur_count,

            SUM(CASE WHEN province LIKE "%BASILAN%" THEN 1 ELSE 0 END) AS Basilan_count,
            SUM(CASE WHEN province LIKE "%LANAO DEL SUR%" THEN 1 ELSE 0 END) AS LanaoDelSur_count,
            SUM(CASE WHEN province LIKE "%MAGUINDANAO%" THEN 1 ELSE 0 END) AS Maguindanao_count,
            SUM(CASE WHEN province LIKE "%SULU%" THEN 1 ELSE 0 END) AS Sulu_count,


            SUM(CASE WHEN province LIKE "%TAWI-TAWI%" THEN 1 ELSE 0 END) AS Tawitawi_count',
            )
            ->first();

        $municipality = DB::table('tbl_clientLogs')
        ->selectRaw(
            'SUM(CASE WHEN municipality LIKE "%PUERTO PRINCESA%" THEN 1 ELSE 0 END) AS PuertoPrincesa_count',

        )->first();

        $clientCount = DB::table('tbl_clientLogs')->count();

        $dailyCount = DB::table('tbl_clientLogs')
            ->whereDate('created_at', today())
            ->count();

        $monthlyCount = DB::table('tbl_clientLogs')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $annualCount = DB::table('tbl_clientLogs')
            ->whereYear('created_at', date('Y'))
            ->count();

        $regions = DB::table('tbl_clientLogs')
            ->select('region', DB::raw('count(*) as total'))
            ->groupBy('region')
            ->get();

        return view('admin.dashboard', compact('clientPurpose', 'clientCount', 'dailyCount', 'monthlyCount', 'annualCount', 'regions', 'province', 'municipality'));
    }

    public function generalReport()
    {
        $clientCount = DB::table('tbl_clientLogs')->count();

        $dailyCount = DB::table('tbl_clientLogs')
            ->whereDate('created_at', today())
            ->count();

        $monthlyCount = DB::table('tbl_clientLogs')
            ->whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count();

        $annualCount = DB::table('tbl_clientLogs')
            ->whereYear('created_at', date('Y'))
            ->count();
        return view('admin.generalReport', compact('clientCount', 'dailyCount', 'monthlyCount', 'annualCount'));
    }

    public function numberOfClients()
    {
        $clientCount = DB::table('tbl_clientLogs')->count();

        // pass the count to your view
        return view('admin.dashboard', ['clientCount' => $clientCount]);
    }
}
