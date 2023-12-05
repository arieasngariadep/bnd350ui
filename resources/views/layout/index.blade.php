<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layout.header')
    </head>

    <body>

        <!-- Top Bar Start -->
        @include('layout.topbar')
        <!-- Top Bar End -->

        <div class="page-wrapper">
            <!-- Left Sidenav -->
            @include('layout.sidebar')
            <!-- end left-sidenav-->

            <!-- Page Content-->
            <div class="page-content">

                <div class="container-fluid">

                    <!-- Page-Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="page-title-box">
                                <div class="float-right">
                                    @yield('breadcrumb')
                                </div>
                                <h4 class="page-title">@yield('title')</h4>
                            </div>
                        </div>
                    </div>
                    <!-- end page title end breadcrumb -->
                    
                    @yield('content')
                    
                </div><!-- container -->

                <footer class="footer text-center text-sm-left">
                    © 2022 BND UI Web <span class="text-muted d-none d-sm-inline-block float-right">Crafted with <i class="mdi mdi-heart text-danger"></i> by Winda Kartika Ningsih</span>
                </footer>
            </div>
            <!-- end page content -->
        </div>
        <!-- end page-wrapper -->


        @include('layout.javascript')
        @include('modal.SearchBulkModal')
    </body>
</html>