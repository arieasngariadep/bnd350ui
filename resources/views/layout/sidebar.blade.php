<?php
    $uri = Request::segment(1);
    $role = Session::get('role_id');
    $kelompok_id = Session::get('kelompok_id');
?>
<div class="left-sidenav">
    <ul class="metismenu left-sidenav-menu" id="side-nav">

        <li class="menu-title">Main</li>

        <li>
            <a href="<?= route('dashboardPage') ?>"><i class="mdi mdi-speedometer"></i><span>Dashboard</span></a>
        </li>

        <?php if($role == 1 || $role == 7 || ($role == 2 && $kelompok_id == 6)) : ?>
        <li>
            <a href="<?= route('formUploadBND350UI') ?>"><i class="mdi mdi-clipboard-outline"></i><span>Form Upload BND350UI</span></a>
        </li>
        <?php endif; ?>

        <li>
            <a href="<?= route('getListBND350UI') ?>"><i class="mdi mdi-format-list-bulleted-type"></i><span>List BND30UI</span></i></span></a>
        </li>

        <li>
            <a href="<?= route('formDownloadReport') ?>"><i class="mdi mdi-cloud-download"></i><span>Download Report</span></i></span></a>
        </li>

        <?php if($role == 1 || $role == 7) : ?>
        <li <?= ($uri == 'users' ? 'class="active"' : '') ?>>
            <a href="<?= route('getListUsers') ?>"><i class="mdi mdi-account-location"></i><span>Users</span></i></span></a>
        </li>
        <?php endif; ?>

    </ul>
</div>