<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function dashboard(){
        $clientPurpose = DB::table('tbl_client_purpose')
        ->selectRaw(
            'SUM(CASE WHEN clientPurpose LIKE "%CAV%" THEN 1 ELSE 0 END) AS CAV_count,
             SUM(CASE WHEN clientPurpose LIKE "%Receiving of Documents%" THEN 1 ELSE 0 END) AS ROD_count,
             SUM(CASE WHEN clientPurpose LIKE "%Submission of Documents%" THEN 1 ELSE 0 END) AS SOD_count,
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

        return view('admin.dashboard', compact('clientPurpose'));
    }

    public function generalReport(){
        return view('admin.generalReport');
    }
}

