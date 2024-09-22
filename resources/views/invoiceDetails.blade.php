<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="/Update/vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="/Update/vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <!-- Datatable -->
    <link href="/Update/vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="/Update/css/style.css" rel="stylesheet">

</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->


    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">

            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">

                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu" id="menu">
                    <li class="nav-label first">Main Menu</li>
                    <!-- <li><a href="index.html"><i class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li> -->
                    <li><a href="{{ route('owner.dashboard') }}" aria-expanded="false"><i
                                class="icon icon-single-04"></i><span class="nav-text">Dashboard</span></a>
                    </li>

                    <li><a href="{{ route('all.services') }}" aria-expanded="false">
                      <i class="icon icon-app-store"></i><span class="nav-text">Services</span></a>
                    </li>
                    <li><a href="{{ route('all.invoices') }}" aria-expanded="false"><i
                                class="icon icon-chart-bar-33"></i><span class="nav-text">Invoices</span></a>
                    </li>
                    <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                                class="icon icon-single-copy-06"></i><span class="nav-text">Actions</span></a>
                        <ul aria-expanded="false">
                            <li><a href="{{ route('user.registration') }}">Register new user</a></li>
                            <li><a href="{{ route('register.service.page') }}">Register new service</a></li>
                            <li><a href="{{ route('create.invoice.page') }}">Create an invoice</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('logout') }}" aria-expanded="false"><i class="fa fa-sign-out"></i><span
                            class="nav-text">Logout</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <span class="ml-1">Invoice details</span>
                        </div>
                    </div>
                </div>
                <!-- row -->


                <div class="container-fluid">
                  <div class="row justify-content-center">
                      <div class="col-lg-8">
                          <div class="card mb-3">
                              <div class="card-body w-100">
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Customer</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->customer_name }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Phone</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->customer_phone }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Issue date</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->date }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Services</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          @foreach($invoices as $invoice)
                                                  {{ $invoice->service_name }} - ${{ $invoice->service_price }}<br>
                                          @endforeach
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Price</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->price }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Invoice number</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->invoice_number }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-3">
                                          <h6 class="mb-0">Status</h6>
                                      </div>
                                      <div class="col-sm-9 text-dark">
                                          {{ $invoices[0]->status }}
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="row">
                                      <div class="col-sm-12">
                                          <a class="btn btn-primary mr-2" href="{{ route('edit.invoice',['id' => $invoices[0]->id]) }}"><i class="fa fa-edit" aria-hidden="true"></i>Edit</a>
                                      </div>
                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->
        <div class="footer">
            <div class="copyright">
                <p>Copyright © All rights reserved</p>
                
            </div>
        </div>
        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="/Update/vendor/global/global.min.js"></script>
    <script src="/Update/js/quixnav-init.js"></script>
    <script src="/Update/js/custom.min.js"></script>
    


    <!-- Datatable -->
    <script src="/Update/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="/Update/js/plugins-init/datatables.init.js"></script>

    <!-- Circle progress -->

</body>

</html>