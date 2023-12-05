@extends('layout.index')
@section('title', 'Form Downlaod Report')
@section('titleTab', 'Form Downlaod Report')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Form Delete BND350UI</li>
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
                <h5 class="mt-0">Form Delete BND350UI</h5>
                <div class="col-mx-4 text-left">
                    <form action="{{ route('deleteBndCreatedAt') }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <div class="col-md-4 text-right">
                            <div class="form-group">
                                <input autocomplete="off" type="date" class="form-control" placeholder="CREATED DATE" id="datepicker-created-at" name="created_at"/>
                            </div>
                        </div>
                        <div class="col-md-4 text-left">
                            <button type="submit" class="btn btn-danger" style="width: 180px; height: 38px;">
                                <i class="dripicons-trash"></i>&nbsp;&nbsp;Delete Data
                            </button>
                        </div>
                    </form>
                </div>

                
                </div>
            </div>
        </div>
    </div>
</div>
@endsection('content')