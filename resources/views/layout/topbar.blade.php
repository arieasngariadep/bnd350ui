<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?= route('dashboardPage') ?>" class="logo">
            <span>
                <img src="{{ asset('assets') }}/images/logo-sm.png" alt="logo-small" class="logo-sm">
            </span>
            <span style="color: white; font-family: cursive; font-size: 12pt">
                &nbsp;&nbsp;BND UI WEB
            </span>
        </a>
    </div>

    <!-- Navbar -->
    <nav class="navbar-custom">

        <ul class="list-unstyled topbar-nav float-right mb-0">

            <li class="hidden-sm">
                <a class="nav-link waves-effect waves-light" href="javascript:void(0);" id="btn-fullscreen">
                    <i class="mdi mdi-fullscreen nav-icon"></i>
                </a>
            </li>

            <li class="dropdown">
                <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                    aria-haspopup="false" aria-expanded="false">
                    <button type="button" class="btn btn-pinterest btn-round ml-1"><i class="far fa-user"></i></button>
                    <span class="ml-1 nav-user-name hidden-sm"><?= Session::get('username'); ?> <i class="mdi mdi-chevron-down"></i> </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item"><i class="dripicons-user text-muted mr-2"></i> <?= Session::get('role_name'); ?></a>
                    <a class="dropdown-item" href="#"><i class="dripicons-gear text-muted mr-2"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?= route('logout') ?>"><i class="dripicons-exit text-muted mr-2"></i> Logout</a>
                </div>
            </li>
        </ul>

        <ul class="list-unstyled topbar-nav mb-0">
                
            <li>
                <button class="button-menu-mobile nav-link waves-effect waves-light">
                    <i class="mdi mdi-menu nav-icon"></i>
                </button>
            </li>
            
        </ul>

    </nav>
    <!-- end navbar-->
</div>