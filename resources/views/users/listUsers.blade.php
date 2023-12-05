@extends('layout.index')
@section('title', 'List Users')
@section('titleTab', 'List Users')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">BND UI Web</a></li>
    <li class="breadcrumb-item"><a href="<?= route('dashboardPage') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">List Users</li>
</ol>
@endsection('breadcrumb')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="mt-0">List Users</h5>
                <?= $alert ?>
                <div class="text-right mb-2">
                    <a href="<?= route('formAddUser') ?>" class="btn btn-purple btn-round"><i class="dripicons-plus"></i> Add New User</a>
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Kelompok</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $no = 1;
                                foreach($userList as $list){
                                    $button = "
                                    <a target='_blank' href='".route('formUpdateUser', ['id' => $list->userId])."' class='btn btn-outline-warning' data-toggle='tooltip' data-placement='top' title='' data-original-title='Edit'>
                                        <i class='mdi mdi-account-edit'></i>
                                    </a> |
                                    <a href='".route('deleteUser', ['id' => $list->userId])."' class='btn btn-outline-danger' data-toggle='tooltip' data-placement='top' title='' data-original-title='Hapus'>
                                        <i class='mdi mdi-account-remove'></i>
                                    </a>";
                                    echo "
                                        <tr>
                                            <td>$no</td>
                                            <td>$list->username</td>
                                            <td>$list->email</td>
                                            <td>$list->role_name</td>
                                            <td>$list->kelompok</td>
                                            <td class='text-center'>$button</td>
                                        </tr>
                                    ";
                                    $no++;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
@endsection('content')