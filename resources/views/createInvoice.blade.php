<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Focus - Bootstrap Admin Dashboard </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./vendor/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <link href="./vendor/chartist/css/chartist.min.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

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
                            <p class="mb-0">Your business dashboard</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-6 col-xxl-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Invoice creation form</h4>
                            </div>
                            <div class="card-body">
                                <div class="basic-form">
                                    <form id="invoiceForm" action="{{ route('create.invoice') }}" method="POST">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label>Customer Name</label>
                                                <input type="text" class="form-control @error('customer_name') is-invalid @enderror" value="{{ old('customer_name') }}" name="customer_name" placeholder="Customer Name">
                                                @error('customer_name')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Customer Phone</label>
                                                <input type="text" class="form-control @error('customer_phone') is-invalid @enderror" value="{{ old('customer_phone') }}" name="customer_phone" placeholder="Customer Phone">
                                                @error('customer_phone')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Service</label>
                                                <select class="form-control @error('service') is-invalid @enderror" name="service[]" multiple id="serviceSelect" onchange="calculateTotalPrice()">
                                                    @foreach($services as $service)
                                                        <option value="{{ $service->id }}" data-price="{{ $service->price }}">{{ $service->name }}</option>
                                                    @endforeach
                                                </select>
                                                <input type="hidden" id="selectedServices" name="selectedServices">
                                                @error('service')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Total Price</label>
                                                <input type="number" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" name="price" id="totalPrice" placeholder="Total price" readonly>
                                                @error('price')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Date</label>
                                                <input type="date" class="form-control @error('date') is-invalid @enderror" name="date">
                                                @error('date')
                                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                                @enderror
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                    <option value="paid">Paid</option>
                                                    <option value="unpaid">Unpaid</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Create</button>
                                    </form>
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
    <script src="./vendor/global/global.min.js"></script>
    <script src="./js/quixnav-init.js"></script>
    <script src="./js/custom.min.js"></script>

    <script src="./vendor/chartist/js/chartist.min.js"></script>

    <script src="./vendor/moment/moment.min.js"></script>
    <script src="./vendor/pg-calendar/js/pignose.calendar.min.js"></script>

    <script src="./js/dashboard/dashboard-2.js"></script>
    <!-- Circle progress -->

    <script>
        // PHP variable to hold services data
        const servicesData = @json($services);

        function calculateTotalPrice() {
            const selectedServices = $('#serviceSelect').val();
            $('#selectedServices').val(selectedServices);

            let totalPrice = 0;
            if (selectedServices) {
                selectedServices.forEach(serviceId => {
                    const service = servicesData.find(service => service.id === parseInt(serviceId));
                    if (service) {
                        totalPrice += parseFloat(service.price);
                    }
                });
            }
            $('#totalPrice').val(totalPrice.toFixed(2));
        }

        $(document).ready(function() {
            $('#serviceSelect').select2({
                placeholder: 'Select services',
                allowClear: true
            });
        });
    </script>
</body>

</html>