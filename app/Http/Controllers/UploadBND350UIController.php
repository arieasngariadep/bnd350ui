<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Alert;
use App\Imports\BND350UIImport;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class UploadBND350UIController extends Controller
{
    public function formUploadBND350UI(Request $request)
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

        return view('formUploadBND350UI', $passing);
    }

    public function prosesUploadBND350UI(Request $request)
    {
        $userId = $request->session()->get('userId');

        foreach ($request->file('file_import') as $file_import) {
            $nama_file_import = $file_import->getClientOriginalName().'.txt';
            $file_import->move(\base_path() ."/public/Import/folder_$userId", $nama_file_import);
        }

        $process = Process::fromShellCommandline('cd D:\xampp\htdocs\bnd_ui\public\Import\folder_'.$userId.' && copy *.txt bnd350ui_'.$userId.'.txt');
        $process->setTimeout(3600);
        $process->run();

        foreach ($request->file('file_import') as $file_import) {
            unlink(base_path('public/Import/folder_'.$userId.'/'.$file_import->getClientOriginalName().'.txt'));
        }
        
        $process = Process::fromShellCommandline('cd D:\xampp\htdocs\bnd_ui\public && python main.py '.$userId.'');
        $process->setTimeout(3600);
        $process->mustRun();

        Excel::import(new BND350UIImport, public_path("/Output_Python/hasil_bnd350ui_$userId.xlsx"));
        unlink(base_path('public/Import/folder_'.$userId.'/bnd350ui_'.$userId.'.txt'));
        unlink(base_path('public/Output_Python/hasil_bnd350ui_'.$userId.'.xlsx'));

        return redirect()->back()->with('alertSuccess', 'Data Berhasil Diparsing');
    }
}
