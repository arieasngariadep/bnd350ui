@extends('layout.index')
@section('title', 'Form Upload BND350UI')
@section('titleTab', 'Form Upload BND350UI')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Form Upload BND350UI</li>
</ol>
@endsection('breadcrumb')

@section('content')
<div class="row">
    <div class="col-lg-12 col-xl-12">
        <?php if($alert): ?>
        <div class="card m-b-30">
            <div class="card-body">
                <?= $alert ?>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mt-0">Form Upload BND350UI</h5>
                <p class="text-muted font-13 mb-4">Upload File Dalam Format <span style="color:red;">(.txt)</span></p>
                <form action="<?= route('prosesUploadBND350UI') ?>" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <div class="col-xl-12">
                            <input type="file" id="input-file-now" class="dropify" name="file_import[]" required multiple />    
                        </div>
                    </div>
                    <div class="form-row ">
                        <div class="col mb-3 text-center">
                            <input type="submit" class="btn btn-primary waves-effect waves-light" style="width: 300px" name="submit" value="Upload File">
                        </div>
                    </div>    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection('content')