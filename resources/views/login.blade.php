<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Login | BND UI Web</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A premium admin dashboard template by themesbrand" name="description" />
        <meta content="Themesbrand" name="author" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo-sm.png">

        <!-- App css -->
        <link href="{{ asset('assets') }}/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/icons.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/metismenu.min.css" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets') }}/css/style.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="bg-white">

        <!-- Log In page -->
        <div class="row">
            <div class="col-lg-3 pr-0">
                <div class="card mb-0 shadow-none">
                    <div class="card-body">
    
                        <h3 class="text-center m-0">
                            <a href="<?= route('loginPage') ?>" class="logo logo-admin"><img src="{{ asset('assets') }}/images/logo-sm.png" height="60" alt="logo" class="my-3"></a>
                        </h3>
    
                        <div class="px-3">
                            <h4 class="text-muted font-18 mb-2 text-center">Welcome Back !</h4>
                            <p class="text-muted text-center">Sign in to continue to BND UI Web.</p>

                            <form class="form-horizontal my-4" action="<?= route('loginProcess') ?>" method="POST">
                                {{ csrf_field() }}
                                <?= $alert ?>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="far fa-user"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                                    </div>
                                </div>
    
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2"><i class="fa fa-key"></i></span>
                                        </div>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    </div>
                                </div>
    
                                <div class="form-group mb-0 row">
                                    <div class="col-12 mt-2">
                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Log In <i class="fas fa-sign-in-alt ml-1"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="mb-0">© 2022 BND UI Web. <br>Crafted with <i class="mdi mdi-heart text-danger"></i> by Winda Kartika Ningsih</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 p-0 h-100vh d-flex justify-content-center">
                <div class="accountbg d-flex align-items-center">
                    <div class="account-title text-center text-white">
                        <h4 class="mt-3">Welcome To <span class="text-warning">BND UI Web</span> </h4>
                        <h1 class="">Let's Get Started</h1>
                        <p class="font-14 mt-3">Aplikasi Monitoring BND350UI.</p>
                        <div class="border w-25 mx-auto border-warning"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Log In page -->

        <!-- jQuery  -->
        <script src="{{ asset('assets') }}/js/jquery.min.js"></script>
        <script src="{{ asset('assets') }}/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('assets') }}/js/metisMenu.min.js"></script>
        <script src="{{ asset('assets') }}/js/waves.min.js"></script>
        <script src="{{ asset('assets') }}/js/jquery.slimscroll.min.js"></script>

        <!-- App js -->
        <script src="{{ asset('assets') }}/js/app.js"></script>

    </body>
</html>
