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

        return view('admin.dashboard', compact('clientPurpose', 'clientCount', 'dailyCount', 'monthlyCount', 'annualCount', 'regions'));
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
