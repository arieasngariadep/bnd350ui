@extends('layout.index')
@section('title', 'Dashboard')
@section('titleTab', 'Dashboard')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection('breadcrumb')

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <img class="d-block w-100" src="{{asset('assets')}}/images/Asset 2-100.jpg" />    
            </div>
        </div>
    </div>
</div><!--end row-->
@endsection('content')