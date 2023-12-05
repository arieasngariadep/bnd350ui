@extends('layout.index')
@section('title', 'List BND350UI')
@section('titleTab', 'List BND350UI')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">List BND350UI</li>
</ol>
@endsection('breadcrumb')

@section('content')
<style>
    th, td {
        white-space: nowrap;
        overflow: hidden;
    }
    .table-wrapper {
        overflow-x: scroll;
        width: 1100px;
        margin: 0 auto;
        table-layout: fixed;
    }
    .address {
        width: 20px !important;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body scrollme">
                <h5 class="mt-0 mb-4">List BND350UI</h5>
                <hr class="mt-1 mb-4">
                <form action="<?= route('getListBND350UI') ?>" method="GET" class="mb-4">
                    <div class="form-material">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input autocomplete="off" type="text" class="form-control" placeholder="TXN DATE" id="datepicker-txn-date" name="txn_date" value="<?= $txn_date ?>" />
                                </div>
                            </div><!--end col-->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input autocomplete="off" type="text" class="form-control" placeholder="PROC DATE" id="datepicker-proc-date" name="proc_date" value="<?= $proc_date ?>" />
                                </div>
                            </div><!--end col-->
                            <div class="col-md-3"> 
                                <div class="form-group">
                                    <input autocomplete="off" type="text" class="form-control" placeholder="MID" id="mid" name="mid" value="<?= $mid ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input autocomplete="off" type="text" class="form-control" placeholder="CARD NUMBER" id="cardnum" name="cardnum" value="<?= $cardnum ?>" />
                                </div>
                            </div>
                        </div><!--end row-->
                        <div class="row">
                            <div class="col-md-3"> 
                                <input autocomplete="off" type="text" class="form-control" placeholder="AUTH" id="auth" name="auth" value="<?= $auth ?>" />
                            </div>
                            <div class="col-md-3"> 
                                <input autocomplete="off" type="text" class="form-control" placeholder="AMOUNT" id="amount" name="amount" value="<?= $amount ?>" />
                            </div>
                            <div class="col-md-6"> 
                                <button type="submit" class="btn btn-primary" style="width: 275px; height: 38px;"><i class="dripicons-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="row">
                    <div class="col-md-5 text-right">
                        <a type="button" class="btn btn-success btn-square btn-outline-dashed waves-effect waves-light" href="../public/excel/format_searchbulk.xlsx"><i class="dripicons-cloud-download mr-2"></i>Download Format</a>
                    </div>
                    <div class="col-md-2 text-center">
                        <button class="btn btn-dark" style="width: 200px; height: 38px;" href="#" data-toggle="modal" data-animation="bounce" data-target=".search-bulk"><i class="dripicons-search"></i> Search Bulk</button>
                    </div>
                    <div class="col-md-5 text-left">
                        <form action="<?= route('prosesReportSearchBulkExport') ?>" method="POST">
                            @csrf
                            <div class="col-md-4 mb-3 text-right">
                                <input type="submit" class="btn btn-secondary waves-effect waves-light" style="width: 200px" name="submit" value="Download Report">
                            </div>
                        </form>
                    </div>
                </div>
                
                <br><hr class="mt-1 mb-4"><br>

                <div class="card-body scrollme">
                    <div class="table-wrapper">
                        <table class="table table-bordered table-striped table-md" style="border-collapse: collapse; border-spacing: 0;font-size: 10pt;">
                            <thead>
                                <tr>
                                    <th>Card Number</th>
                                    <th>Txn Date</th>
                                    <th>Proc Date</th>
                                    <th>Amount</th>
                                    <th>Disc Amount</th>
                                    <th>Auth</th>
                                    <th>Rate</th>
                                    <th>MID</th>
                                    <th>Account Number</th>
                                    <th>Merchant Name</th>
                                    <th class="address">Address</th>
                                </tr>
                            </thead>

                            @if(isset($listBND))
                            <tbody>
                                @if(count($listBND) > 0)
                                    @foreach($listBND as $list)
                                        <tr>
                                            <td>{{ $list->cardnum }}</td>
                                            <td>{{ $list->txn_date }}</td>
                                            <td>{{ $list->proc_date }}</td>
                                            <td>{{ number_format($list->amount, 2) }}</td>
                                            <td>{{ number_format($list->disc_amount, 2) }}</td>
                                            <td>{{ $list->auth }}</td>
                                            <td>{{ $list->rate }}</td>
                                            <td>{{ $list->mid }}</td>
                                            <td>{{ $list->account_number }}</td>
                                            <td>{{ $list->mname }}</td>
                                            <td class="address">{{ $list->alamat }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr><td colspan="11" class="text-center ">No Result Found</td></tr>
                                @endif
                            </tbody>
                            @endif
                        </table>
                
                        @if(isset($listBND))
                        <div class="row">
                            <div class="col-md-5">
                                @if(count($listBND) > 0)
                                <div class="pull-left">
                                    Showing {{ $listBND->firstItem() }} to {{ $listBND->lastItem() }} of {{ number_format($listBND->total()) }} entries
                                </div>
                                @else
                                <div class="pull-left">
                                    Showing 0 to 0 of {{ $listBND->total() }} entries
                                </div>
                                @endif
                            </div>
                            <div class="col-md-7">
                                <div class="pull-right">
                                    {{ $listBND->links('layout.pagination') }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection('content')