<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alert;

class DashboardController extends Controller
{
    public function dashboardPage(Request $request)
    {
        $alert = $request->session()->get('alert');
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertInfo = $request->session()->get('alertInfo');
        if($alertSuccess){
            $showalert = Alert::alertSuccess($alertSuccess);
        }else if($alertInfo){
            $showalert = Alert::alertinfo($alertInfo);
        }else{
            $showalert = Alert::alertDanger($alert);
        }

        $passing = array(
            'alert' => $showalert,
        );

        return view('dashboard', $passing);
    }
}
