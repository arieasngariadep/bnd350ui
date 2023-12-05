<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alert;
use App\Models\BND350UIModel;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SearchBulkImport;
use App\Exports\ReportSearchExport;
use App\Exports\ReportSearchBulkExport;

class listBND350UIController extends Controller
{
    public function getlistBND350UI(Request $request)
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

        $txn_date = $request->txn_date;
        $proc_date = $request->proc_date;
        $mid = $request->mid;
        $cardnum = $request->cardnum;
        $auth = $request->auth;
        $amount = $request->amount;

        $listBND = BND350UIModel::getListBND350UI($txn_date, $proc_date, $mid, $cardnum, $auth, $amount);

        $passing = array(
            'alert' => $showalert,
            'txn_date' => $txn_date,
            'proc_date' => $proc_date,
            'mid' => $mid,
            'cardnum' => $cardnum,
            'auth' => $auth,
            'amount' => $amount,
            'listBND' => $listBND,
        );
    
        return view('listBND350UI', $passing);
    }

    public function prosesUploadSearchBulk(Request $request)
    {
        $userId = $request->session()->get('userId');

        DB::statement('drop table if exists data_bulk_'.$userId.', result_searchbulk_'.$userId.'');
        DB::statement('create table data_bulk_'.$userId.' 
            (
                cardnum varchar(255),
                txn_date varchar(255),
                proc_date varchar(255),
                amount varchar(255),
                disc_amount varchar(255),
                auth varchar(255),
                rate varchar(255),
                mid varchar(255),
                account_number varchar(255),
                mname varchar(255),
                alamat varchar(255)
            ) engine myisam');

        $file_import = $request->file('file_import');
        $nama_file_import = 'data_bulk_'.$userId.''.'.'.$file_import->getClientOriginalExtension();
        $file_import->move(\base_path() ."/public/Import", $nama_file_import);

        Excel::import(new SearchBulkImport($userId), public_path("/Import/".$nama_file_import));
        DB::statement('alter table data_bulk_'.$userId.' convert to character set utf8mb4 collate utf8mb4_unicode_ci');
        DB::statement('alter table data_bulk_'.$userId.' add column no int auto_increment primary key first');
        unlink(public_path("Import/$nama_file_import"));

        DB::statement('create table result_searchbulk_'.$userId.' like bnd350ui');
        $subquery1 = DB::table('data_bulk_'.$userId.'')->select('cardnum');
        $subquery2 = DB::table('data_bulk_'.$userId.'')->select('txn_date');
        $subquery3 = DB::table('data_bulk_'.$userId.'')->select('proc_date');
        $subquery4 = DB::table('data_bulk_'.$userId.'')->select('amount');
        $subquery5 = DB::table('data_bulk_'.$userId.'')->select('disc_amount');
        $subquery6 = DB::table('data_bulk_'.$userId.'')->select('auth');
        $subquery7 = DB::table('data_bulk_'.$userId.'')->select('rate');
        $subquery8 = DB::table('data_bulk_'.$userId.'')->select('mid');
        $subquery9 = DB::table('data_bulk_'.$userId.'')->select('account_number');
        $subquery10 = DB::table('data_bulk_'.$userId.'')->select('mname');
        $subquery11 = DB::table('data_bulk_'.$userId.'')->select('alamat');

        $query = BND350UIModel::select('*');

        if(in_array('cardnum', $request->kolom))
        {
            $query->whereIn('cardnum', $subquery1);
        }

        if(in_array('txn_date', $request->kolom))
        {
            $query->whereIn('txn_date', $subquery2);
        }

        if(in_array('proc_date', $request->kolom))
        {
            $query->whereIn('proc_date', $subquery3);
        }

        if(in_array('amount', $request->kolom))
        {
            $query->whereIn('amount', $subquery4);
        }

        if(in_array('disc_amount', $request->kolom))
        {
            $query->whereIn('disc_amount', $subquery5);
        } 

        if(in_array('auth', $request->kolom))
        {
            $query->whereIn('auth', $subquery6);
        }

        if(in_array('rate', $request->kolom))
        {
            $query->whereIn('rate', $subquery7);
        }

        if(in_array('mid', $request->kolom))
        {
            $query->whereIn('mid', $subquery8);
        }

        if(in_array('account_number', $request->kolom))
        {
            $query->whereIn('account_number', $subquery9);
        } 

        if(in_array('mname', $request->kolom))
        {
            $query->whereIn('mname', $subquery10);
        }

        if(in_array('alamat', $request->kolom))
        {
            $query->whereIn('alamat', $subquery11);
        }

        $bindings = $query->getBindings();
        $insertQuery = 'INSERT into result_searchbulk_'.$userId.' '.$query->toSql();
        DB::insert($insertQuery, $bindings);

        return redirect('listResultBND350UI/'.$userId.'')->with('alertSuccess', 'Data Berhasil Dicari');
    }

    public function getListResultBND350UI(Request $request)
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

        $userId = $request->session()->get('userId');
        $txn_date = $request->txn_date;
        $proc_date = $request->proc_date;
        $mid = $request->mid;
        $cardnum = $request->cardnum;
        $auth = $request->auth;
        $amount = $request->amount;

        if(isset($userId))
        {
            $listBND = DB::table('result_searchbulk_'.$userId.'')->paginate(5);
            $listBND->appends($request->all());

            $data = array(
                'listBND' => $listBND,
                'txn_date' => $txn_date,
                'proc_date' => $proc_date,
                'mid' => $mid,
                'cardnum' => $cardnum,
                'auth' => $auth,
                'amount' => $amount,
                'alert' => $showalert,
            );
    
            return view('listResultBND350UI', $data);
        }else
        {
            $data = array(
                'txn_date' => $txn_date,
                'proc_date' => $proc_date,
                'mid' => $mid,
                'cardnum' => $cardnum,
                'auth' => $auth,
                'amount' => $amount,
                'alert' => $showalert,
            );
    
            return view('listResultBND350UI', $data);
        }
    }

    public function prosesReportSearchExport(Request $request)
    {
        $txn_date = $request->txn_date;
        $proc_date = $request->proc_date;
        $mid = $request->mid;
        $cardnum = $request->cardnum;
        $auth = $request->auth;
        $amount = $request->amount;
        return Excel::download(new ReportSearchExport($txn_date, $proc_date, $mid, $cardnum, $auth, $amount), "Report BND350UI.xlsx");
    }

    public function prosesReportSearchBulkExport(Request $request)
    {
        $userId = $request->session()->get('userId');
        return Excel::download(new ReportSearchBulkExport($userId), "Report BND350UI.xlsx");
    }

    public function formDeleteBND350UI(Request $request){
        $alertSuccess = $request->session()->get('alertSuccess');
        $alertFail = $request->session()->get('alertFail');
        $showalert = null;
        if($alertSuccess){
            $showalert = Alert::alertSuccess($alertSuccess);
        }else if($alertFail){
            $showalert = Alert::alertFail($alertFail);
        }

        $data = array(
            'alert' => $showalert,
        );

        return view('formDeleteByDateBND350UI',$data);
    }

    public function deleteBndCreatedAt(Request $request){
        if($request->created_at == NULL || $request->created_at == ' '){
            return redirect()->back()->with('alertFail','Tidak ada data yang dihapus');
        }else{
            $created_at = $request->created_at;
            BND350UIModel::deleteBndUIByCreatedAt($created_at);
        } 
        return redirect()->back()->with('alertSuccess','Data Berhasil Dihapus');
    }
}
