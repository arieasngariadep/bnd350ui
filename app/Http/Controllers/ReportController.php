<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alert;
use App\Models\BND350UIModel;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportBND350UIExport;

class ReportController extends Controller
{
    public function formDownloadReport(Request $request)
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

        $txn_date_start = $request->txn_date_start;
        $txn_date_end = $request->txn_date_end;
        $proc_date_start = $request->proc_date_start;
        $proc_date_end = $request->proc_date_end;
        // $dataReport = BND350UIModel::getDataReport($txn_date_start, $txn_date_end, $proc_date_start, $proc_date_end);

        $passing = array(
            'alert' => $showalert,
            // 'dataReport' => $dataReport,
            'txn_date_start' => $txn_date_start,
            'txn_date_end' => $txn_date_end,
            'proc_date_start' => $proc_date_start,
            'proc_date_end' => $proc_date_end,
        );

        return view('formDownloadReport', $passing);
    }

    public function prosesDownloadReport(Request $request)
    {
        $txn_date_start = $request->txn_date_start;
        $txn_date_end = $request->txn_date_end;
        $proc_date_start = $request->proc_date_start;
        $proc_date_end = $request->proc_date_end;
        return Excel::download(new ReportBND350UIExport($txn_date_start, $txn_date_end, $proc_date_start, $proc_date_end), "Report BND350UI.xlsx");
    }

    public function prosesDeleteData(Request $request)
    {
        $txn_date_start = $request->txn_date_start;
        $txn_date_end = $request->txn_date_end;
        $proc_date_start = $request->proc_date_start;
        $proc_date_end = $request->proc_date_end;

        if($txn_date_start != NULL && $txn_date_end != NULL){
            BND350UIModel::whereBetween('txn_date', [$txn_date_start, $txn_date_end])->delete();
        }else{
            BND350UIModel::whereBetween('proc_date', [$proc_date_start, $proc_date_end])->delete();
        }

        return redirect('/formDownloadReport')->with('alertSuccess', 'Data Berhasil Dihapus');
    }
}
