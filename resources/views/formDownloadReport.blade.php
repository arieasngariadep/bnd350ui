@extends('layout.index')
@section('title', 'Form Downlaod Report')
@section('titleTab', 'Form Downlaod Report')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Form Downlaod Report</li>
</ol>
@endsection('breadcrumb')

@section('content')
<?php 
    $role = Session::get('role_id');
?>
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <?= $alert ?>
                <h5 class="mt-0">Form Downlaod Report</h5>
                <form action="<?= route('formDownloadReport') ?>" method="GET" class="mb-4">
                    <div class="form-material">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">TXN DATE</label>
                                    <input autocomplete="off" id="datepicker-txn-date" type="text" class="form-control" name="txn_date_start" placeholder="TXN DATE START" value="<?= $txn_date_start ?>" />
                                </div>
                                <div class="form-group">
                                    <label class="">PROC DATE</label>
                                    <input autocomplete="off" id="datepicker-proc-date" type="text" class="form-control" name="proc_date_start" placeholder="PROC DATE START" value="<?= $proc_date_start ?>" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="">TXN DATE</label>
                                    <input autocomplete="off" id="datepicker-txn-date-end" type="text" class="form-control" name="txn_date_end" placeholder="TXN DATE END" value="<?= $txn_date_end ?>" />
                                </div>
                                <div class="form-group">  
                                    <label class="">PROC DATE</label>    
                                    <input autocomplete="off" id="datepicker-proc-date-end" type="text" class="form-control" name="proc_date_end" placeholder="PRROC DATE END" value="<?= $proc_date_end ?>" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-4 mb-3 text-right">
                            <button type="submit" class="btn btn-dark waves-effect waves-light" style="width: 250px">Proses</button>
                        </div>
                </form>
                
                <?php 
                    if($txn_date_start != NULL || $proc_date_start != NULL || $txn_date_end != NULL || $proc_date_end != NULL) : 
                        if($role == 1 || $role == 7) :
                ?>

                <form action="<?= route('prosesDownloadReport') ?>" method="POST">
                    @csrf
                    <input type="text" class="form-controle" name="txn_date_start" value="<?= $txn_date_start ?>" hidden />
                    <input type="text" class="form-controle" name="proc_date_start" value="<?= $proc_date_start ?>" hidden />
                    <input type="text" class="form-controle" name="txn_date_end" value="<?= $txn_date_end ?>" hidden />
                    <input type="text" class="form-controle" name="proc_date_end" value="<?= $proc_date_end ?>" hidden />
                    <div class="col-md-4 mb-3 text-right">
                        <button type="submit" class="btn btn-primary" style="width: 250px"><i class="dripicons-download"></i> Download Report</button>
                    </div>
                </form>
                
                <form action="<?= route('prosesDeleteData') ?>" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="text" class="form-controle" name="txn_date_start" value="<?= $txn_date_start ?>" hidden />
                    <input type="text" class="form-controle" name="proc_date_start" value="<?= $proc_date_start ?>" hidden />
                    <input type="text" class="form-controle" name="txn_date_end" value="<?= $txn_date_end ?>" hidden />
                    <input type="text" class="form-controle" name="proc_date_end" value="<?= $proc_date_end ?>" hidden />
                    <div class="col-md-4 mb-3 text-right">
                        <input type="submit" class="btn btn-danger waves-effect waves-light" style="width: 250px" name="submit" value="Delete Data">
                    </div>
                </form>
                <?php 
                    endif; 
                        endif;
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')